<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPasswordChangeController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\RoomManagerController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CleaningServiceController;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;

Route::get('/', LandingController::class)->name('home');

// Show login form (kept as closure to preserve role selector query)
Route::get('/login', function () {
    $currentRole = request('role', 'user'); // Default role is 'user' if not specified
    return view('auth.login', compact('currentRole'));
})->name('login');

// Handle login POST
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

// Registration (show + submit)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'submit'])->name('password.email');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookings/calendar', [UserBookingController::class, 'calendar'])->name('bookings.calendar');
    Route::get('/bookings/history', [UserBookingController::class, 'history'])->name('bookings.history');
    Route::get('/bookings/create/{room}', [UserBookingController::class, 'create'])->name('bookings.create');
    Route::get('/bookings/{booking}/edit', [UserBookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [UserBookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [UserBookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('bookings.store');

    Route::get('/notifications', [NotificationController::class, 'webIndex'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'webMarkAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/read', [NotificationController::class, 'webDeleteAllRead'])->name('notifications.delete-read');
    Route::post('/notifications/{notification}/toggle-read', [NotificationController::class, 'webToggleRead'])->name('notifications.toggle-read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'webDestroy'])->name('notifications.destroy');
});

// Admin routes - protected by role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Bookings management
    Route::get('/admin/bookings/pending', [AdminController::class, 'pending'])->name('admin.bookings.pending');
    Route::post('/admin/bookings/{booking}/approve', [AdminController::class, 'approve'])->name('admin.bookings.approve');
    Route::post('/admin/bookings/{booking}/reject', [AdminController::class, 'reject'])->name('admin.bookings.reject');

    // RUANGAN (CRUD)
    Route::resource('admin/rooms', AdminRoomController::class)->names('admin.rooms');
    Route::get('/admin/api/peminjam-users', [AdminRoomController::class, 'getPeminjamUsers'])->name('admin.api.peminjam-users');
    Route::get('/admin/api/room-types', [AdminRoomController::class, 'getRoomTypes'])->name('admin.api.room-types');

    // JENIS RUANGAN (CRUD)
    Route::resource('admin/room-types', App\Http\Controllers\Admin\RoomTypeController::class)->names('admin.room-types');

    // PEMINJAM: kelola user dengan role peminjam
    Route::get('/admin/users/peminjam', [AdminUserController::class, 'indexPeminjam'])->name('admin.users.peminjam');
    Route::get('/admin/users/non-peminjam', [AdminUserController::class, 'indexNonPeminjam'])->name('admin.users.nonpeminjam');
    Route::get('/admin/users/create/{role?}', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store/{role?}', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    // PENGATURAN
    Route::get('/admin/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/admin/settings/clear-cache', [AdminSettingController::class, 'clearCache'])->name('admin.settings.clear-cache');

    // Password Change Requests
    Route::get('/admin/password-change-requests', [AdminPasswordChangeController::class, 'index'])->name('admin.password-change.index');
    Route::post('/admin/password-change-requests/{passwordChangeRequest}/approve', [AdminPasswordChangeController::class, 'approve'])->name('admin.password-change.approve');
    Route::post('/admin/password-change-requests/{passwordChangeRequest}/reject', [AdminPasswordChangeController::class, 'reject'])->name('admin.password-change.reject');
});

// Room Manager routes (for peminjam who manage rooms)
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/room-manager/dashboard', [RoomManagerController::class, 'dashboard'])->name('room-manager.dashboard');
    Route::get('/room-manager/rooms', [RoomManagerController::class, 'rooms'])->name('room-manager.rooms');
    Route::get('/room-manager/rooms/{room}', [RoomManagerController::class, 'showRoom'])->name('room-manager.show-room');
    Route::get('/room-manager/pending-bookings', [RoomManagerController::class, 'pendingBookings'])->name('room-manager.pending-bookings');
    Route::get('/room-manager/upcoming-bookings', [RoomManagerController::class, 'upcomingBookings'])->name('room-manager.upcoming-bookings');
    Route::post('/room-manager/bookings/{booking}/approve', [RoomManagerController::class, 'approveBooking'])->name('room-manager.approve-booking');
    Route::post('/room-manager/bookings/{booking}/reject', [RoomManagerController::class, 'rejectBooking'])->name('room-manager.reject-booking');
    Route::post('/room-manager/bookings/{booking}/change-request', [RoomManagerController::class, 'submitChangeRequest'])->name('room-manager.change-request');
});

// Kepala Sekolah routes
Route::middleware(['auth', 'role:kepala_sekolah'])->group(function () {
    Route::get('/kepala-sekolah/dashboard', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/kepala-sekolah/reports/export/pdf', [ReportController::class, 'exportPDF'])->name('reports.export.pdf');
    Route::post('/kepala-sekolah/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
});

// Cleaning Service routes
Route::middleware(['auth', 'role:cleaning_service'])->group(function () {
    Route::get('/cleaning-service/dashboard', [CleaningServiceController::class, 'index'])->name('cleaning-service.dashboard');
    Route::get('/cleaning-service/schedule', [CleaningServiceController::class, 'schedule'])->name('cleaning-service.schedule');
});