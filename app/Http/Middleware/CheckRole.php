<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Daftar role yang diizinkan akses
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.'
                ], 401);
            }
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek apakah user memiliki salah satu dari role yang diizinkan
        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden. You do not have permission to access this resource.',
                    'required_roles' => $roles,
                    'your_role' => $user->role
                ], 403);
            }

            // Untuk web, redirect ke halaman yang sesuai dengan role
            return $this->redirectBasedOnRole($user->role);
        }

        return $next($request);
    }
    /**
     * Redirect user berdasarkan role mereka
     */
    private function redirectBasedOnRole(string $role): Response
    {
        return match($role) {
            'admin' => (Route::has('admin.dashboard')
                ? redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access that page.')
                : redirect()->route('login')->with('error', 'Admin dashboard route not found. Please contact administrator.')),
            'kepala_sekolah' => redirect()->route('reports.index')
                ->with('error', 'You do not have permission to access that page.'),
            'cleaning_service' => redirect()->route('dashboard')
                 ->with('info', 'Anda dialihkan ke dashboard petugas kebersihan.'),
              'guru' => redirect()->route('dashboard')
                 ->with('info', 'Anda dialihkan ke dashboard guru.'),
            'peminjam' => redirect()->route('dashboard')
                 ->with('info', 'Silakan kelola peminjaman Anda di dashboard.'),
            default => redirect()->route('login')
                ->with('error', 'Invalid role detected. Please contact administrator.')
        };
    }
    
}
