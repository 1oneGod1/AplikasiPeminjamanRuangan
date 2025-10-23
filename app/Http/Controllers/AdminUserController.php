<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    private const NON_PEMINJAM_EXCLUDED_ROLES = ['peminjam', 'guru'];
    private const ALLOWED_ROLES = ['kepala_sekolah', 'cleaning_service', 'peminjam'];

    /**
     * Display a listing of peminjam users.
     */
    public function indexPeminjam()
    {
        $peminjam = User::where('role', 'peminjam')
            ->orderBy('name')
            ->paginate(10);

        $totalPeminjam = User::where('role', 'peminjam')->count();
        $activePeminjam = User::where('role', 'peminjam')
            ->where('is_active', true)
            ->count();

        return view('admin.users.peminjam', compact('peminjam', 'totalPeminjam', 'activePeminjam'));
    }

    /**
     * Display a listing of non-peminjam users (admin, kepala sekolah, cleaning service).
     */
    public function indexNonPeminjam()
    {
        $users = User::whereNotIn('role', self::NON_PEMINJAM_EXCLUDED_ROLES)
            ->orderBy('name')
            ->get();

        return view('admin.users.non-peminjam', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create($role = null)
    {
        if (!in_array($role, self::ALLOWED_ROLES, true)) {
            $role = null;
        }

        return view('admin.users.create', compact('role'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:' . implode(',', self::ALLOWED_ROLES),
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.users.create', $request->role)
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'is_active' => $request->status === 'active',
        ]);

        return redirect()
            ->route($this->redirectRouteForRole($request->role))
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:' . implode(',', self::ALLOWED_ROLES),
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'is_active' => $request->status === 'active',
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route($this->redirectRouteForRole($request->role))
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $hasUpcomingBookings = $user->bookings()
            ->whereIn('status', ['pending', 'approved'])
            ->where('booking_date', '>=', now()->toDateString())
            ->exists();

        if ($hasUpcomingBookings) {
            return back()->with('error', 'User tidak dapat dihapus karena masih memiliki peminjaman aktif.');
        }

        $role = $user->role;
        $user->delete();

        return redirect()
            ->route($this->redirectRouteForRole($role))
            ->with('success', 'User berhasil dihapus');
    }

    private function redirectRouteForRole(string $role): string
    {
        return $role === 'peminjam'
            ? 'admin.users.peminjam'
            : 'admin.users.nonpeminjam';
    }
}
