<?php

namespace App\Http\Controllers;

use App\Models\PasswordChangeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPasswordChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of password change requests
     */
    public function index()
    {
        $pendingRequests = PasswordChangeRequest::with('user')
            ->where('status', PasswordChangeRequest::STATUS_PENDING)
            ->orderBy('created_at', 'desc')
            ->get();

        $recentRequests = PasswordChangeRequest::with(['user', 'processedBy'])
            ->whereIn('status', [PasswordChangeRequest::STATUS_APPROVED, PasswordChangeRequest::STATUS_REJECTED])
            ->orderBy('processed_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.password-change.index', compact('pendingRequests', 'recentRequests'));
    }

    /**
     * Approve a password change request
     */
    public function approve(Request $request, PasswordChangeRequest $passwordChangeRequest)
    {
        if ($passwordChangeRequest->status !== PasswordChangeRequest::STATUS_PENDING) {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        // Update user's password
        $user = $passwordChangeRequest->user;
        $user->password = $passwordChangeRequest->new_password;
        $user->save();

        // Update request status
        $passwordChangeRequest->update([
            'status' => PasswordChangeRequest::STATUS_APPROVED,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return back()->with('success', 'Perubahan password telah disetujui.');
    }

    /**
     * Reject a password change request
     */
    public function reject(Request $request, PasswordChangeRequest $passwordChangeRequest)
    {
        if ($passwordChangeRequest->status !== PasswordChangeRequest::STATUS_PENDING) {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ], [
            'admin_notes.required' => 'Alasan penolakan harus diisi.',
            'admin_notes.max' => 'Alasan penolakan maksimal 500 karakter.',
        ]);

        $passwordChangeRequest->update([
            'status' => PasswordChangeRequest::STATUS_REJECTED,
            'processed_by' => Auth::id(),
            'processed_at' => now(),
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return back()->with('success', 'Perubahan password telah ditolak.');
    }
}
