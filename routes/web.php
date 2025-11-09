<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\HelpController;

// Public Routes
Route::get('/', [ProductController::class, 'featured'])->name('home');

// Help/FAQ Routes
Route::get('/help', [HelpController::class, 'index'])->name('help.index');
Route::get('/help/content', [HelpController::class, 'getHelpContent'])->name('help.content');

// Contact Routes (Public)
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Favourite routes
    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourites/{product}/toggle', [FavouriteController::class, 'toggle'])->name('favourites.toggle');
    Route::delete('/favourites/{favourite}', [FavouriteController::class, 'destroy'])->name('favourites.destroy');

    // Order routes
    Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::patch('products/{product}/toggle-featured', [AdminProductController::class, 'toggleFeatured'])->name('products.toggleFeatured');
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::patch('contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.update-status');
    
    // Message Board Routes (Admin Only)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/toggle-pin', [MessageController::class, 'togglePin'])->name('messages.toggle-pin');
    Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');
});

// Register Admin Middleware
Route::aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
