<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserAuthController;

// Landing page (root)
Route::get('/', [LandingController::class, 'index'])->name('landing.page');

// Booking page
Route::get('/booking', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'submitForm'])->name('booking.submit');

// Feedback page
Route::get('/feedback', [FeedbackController::class, 'showForm'])->name('feedback.form');
Route::post('/feedback', [FeedbackController::class, 'submitForm'])->name('feedback.submit');

// Admin login & dashboard
// Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin booking management
Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
Route::get('/admin/guests', [AdminController::class, 'guests'])->name('admin.guests');
Route::get('/admin/feedback', [AdminController::class, 'feedback'])->name('admin.feedback');
Route::get('/admin/promo', [AdminController::class, 'promo'])->name('admin.promo');

// Admin actions
Route::post('/admin/bookings/delete/{id}', [AdminController::class, 'deleteBooking'])->name('admin.bookings.delete');
Route::post('/admin/feedback/approve/{id}', [AdminController::class, 'approveFeedback'])->name('admin.feedback.approve');
Route::post('/admin/feedback/delete/{id}', [AdminController::class, 'deleteFeedback'])->name('admin.feedback.delete');
Route::post('/admin/promo/add', [AdminController::class, 'addPromo'])->name('admin.promo.add');
Route::post('/admin/promo/edit/{id}', [AdminController::class, 'editPromo'])->name('admin.promo.edit');
Route::post('/admin/promo/delete/{id}', [AdminController::class, 'deletePromo'])->name('admin.promo.delete');

// API dummy for JSON data (for development)
Route::get('/api/dummy/bookings', function() {
    return response()->file(storage_path('app/data/bookings.json'));
});
Route::get('/api/dummy/guests', function() {
    return response()->file(storage_path('app/data/guests.json'));
});
Route::get('/api/dummy/feedback', function() {
    return response()->file(storage_path('app/data/feedback.json'));
});
Route::get('/api/dummy/promo', function() {
    return response()->file(storage_path('app/data/promo.json'));
});

// User login & logout
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// User register
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register']);
