<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// User / umum
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\SeatController as AdminSeatController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

/*
|--------------------------------------------------------------------------
| ROUTE AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| ROUTE UMUM / USER
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

/*
|--------------------------------------------------------------------------
| ROUTE PELANGGAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    Route::get('/schedules/{schedule}/seats', [BookingController::class, 'selectSeats'])
        ->name('booking.seats');

    Route::post('/schedules/{schedule}/checkout', [BookingController::class, 'checkout'])
        ->name('booking.checkout');

    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'show'])
        ->name('payment.show');

    Route::post('/bookings/{booking}/payment/refresh', [PaymentController::class, 'refreshToTicket'])
        ->name('payment.refresh');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::get('/tickets/{ticket}', [BookingController::class, 'ticket'])
        ->name('tickets.show');

    Route::get('/riwayat-pesanan', [BookingController::class, 'history'])
        ->name('bookings.history');
});

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [ReportController::class, 'dashboard'])->name('dashboard');

        // Movies
        Route::resource('movies', AdminMovieController::class);

        /**
         * ✅ FILTER JADWAL PER HARI + KURSI TERSEDIA (CUSTOM ROUTES)
         * TARUH DI ATAS resource('schedules') biar gak ketabrak {schedule}
         */
        Route::get('schedules/availability', [AdminScheduleController::class, 'availability'])
            ->name('schedules.availability');

        Route::get('schedules/{schedule}/availability', [AdminScheduleController::class, 'availabilityDetail'])
            ->name('schedules.availability.detail');

        // Schedules (resource)
        Route::resource('schedules', AdminScheduleController::class);

        // Seats
        Route::resource('seats', AdminSeatController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        // Users
        Route::resource('users', AdminUserController::class)
            ->only(['index', 'update', 'destroy']);

        Route::get('reports/sales', [ReportController::class, 'sales'])
            ->name('reports.sales');

        Route::get('bookings', [AdminBookingController::class, 'index'])
            ->name('bookings.index');

        Route::post('bookings/{booking}/mark-paid', [AdminBookingController::class, 'markPaid'])
            ->name('bookings.mark-paid');
    });
