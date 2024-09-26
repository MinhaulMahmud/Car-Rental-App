<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/dashboard', function () {
//     return view('admin.admindashboard');
// })->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin');

Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('/admin/dashboard', [CustomerController::class, 'dashboard'])->name('admin');

    // Manage Cars Routes
    Route::get('/admin/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/admin/cars', [CarController::class, 'storeOrUpdate'])->name('cars.store');
    Route::get('/admin/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/admin/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/admin/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Manage Customer Routes
   
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/admin/customers/{customer}/rental-history', [CustomerController::class, 'showRentalHistory'])->name('customers.rental-history');
    
    // Manage Rentals Routes
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('rentals.index');
    Route::get('/admin/rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('rentals.edit');
    Route::post('/admin/rentals/{rental}', [AdminRentalController::class, 'update'])->name('rentals.update');
    Route::delete('/admin/rentals/{rental}', [AdminRentalController::class, 'destroy'])->name('rentals.destroy');
    
});




// Frontend routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

// Rental routes for customers
Route::middleware(['auth', 'rolemanager:customer'])->group(function () {
    Route::get('/rentals/{car_id}/book', [RentalController::class, 'book'])->name('rentals.book.form');
    Route::get('/rentals/dashboard', action: [RentalController::class, 'index'])->name('rentals.dashboard');
    Route::post('/rentals/{car_id}/book', [RentalController::class, 'store'])->name('rentals.book');
    Route::get('/rentals/{id}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
