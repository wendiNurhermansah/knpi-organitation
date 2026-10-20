<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AspirationController as AdminAspirationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - KNPI Digital Ecosystem
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [ArticleController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [ArticleController::class, 'show'])->name('berita.show');
Route::get('/okp', [OrganizationController::class, 'index'])->name('okp.index');
Route::get('/agenda', [EventController::class, 'index'])->name('agenda.index');
Route::post('/agenda/{event}/register', [EventRegistrationController::class, 'store'])->name('agenda.register');
Route::post('/aspirasi', [AspirationController::class, 'store'])->name('aspirasi.store');
Route::get('/aspirasi/lacak', [AspirationController::class, 'track'])->name('aspirasi.track');

// Language Switcher Route (ID / EN)
Route::get('/lang/{locale}', [\App\Http\Controllers\LocaleController::class, 'switch'])->name('locale.switch');

// Authentication & Security Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/captcha/refresh', [AuthController::class, 'refreshCaptcha'])->name('captcha.refresh');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================================
// 2. ADMIN ROUTES (Protected with 'auth' middleware and prefixed with '/admin')
// ==========================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Custom OKP Verification Action
    Route::patch('/okp/{organization}/verify', [AdminOrganizationController::class, 'verify'])->name('okp.verify');

    // Resource Routes
    Route::resource('berita', AdminArticleController::class)->parameters(['berita' => 'article']);
    Route::resource('agenda', AdminEventController::class)->parameters(['agenda' => 'event']);
    Route::resource('okp', AdminOrganizationController::class)->parameters(['okp' => 'organization']);

    // Manage Aspirations (Tickets & Responses)
    Route::get('/aspirasi', [AdminAspirationController::class, 'index'])->name('aspirasi.index');
    Route::patch('/aspirasi/{aspiration}', [AdminAspirationController::class, 'update'])->name('aspirasi.update');
});
