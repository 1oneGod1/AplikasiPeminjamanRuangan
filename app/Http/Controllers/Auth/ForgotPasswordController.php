<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordChangeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Display the forgot password form
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle forgot password submission
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan dalam sistem.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        // Check if there's already a pending request
        $existingRequest = $user->pendingPasswordChangeRequest;

        if ($existingRequest) {
            // Update the existing request
            $existingRequest->update([
                'new_password' => Hash::make($request->password),
                'created_at' => now(),
            ]);
        } else {
            // Create new password change request
            PasswordChangeRequest::create([
                'user_id' => $user->id,
                'new_password' => Hash::make($request->password),
                'status' => PasswordChangeRequest::STATUS_PENDING,
            ]);
        }

        return redirect()->route('login')->with('status', 'Pengajuan perubahan password telah dikirim. Mohon menunggu persetujuan admin.');
    }
}
