<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\FleetProviderDashboardController;
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
    Route::get('/admin/cars', [CarController::class, 'index'])->name('admin.cars.index');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/admin/cars', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('/admin/cars/{car}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/admin/cars/{car}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/admin/cars/{car}', [CarController::class, 'destroy'])->name('admin.cars.destroy');

    // Manage Customer Routes
   
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/admin/customers/{customer}/rental-history', [CustomerController::class, 'showRentalHistory'])->name('customers.rental-history');
    
    // Manage Rentals Routes
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('rentals.index');
    Route::get('/admin/rentals/{rental}/edit', [AdminRentalController::class, 'edit'])->name('rentals.edit');
    Route::put('/admin/rentals/{rental}', [AdminRentalController::class, 'update'])->name('rentals.update');
    Route::delete('/admin/rentals/{rental}', [AdminRentalController::class, 'destroy'])->name('rentals.destroy');
    
});




// Frontend routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/cars', [FrontendCarController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [FrontendCarController::class, 'show'])->name('frontend.cars.show');

// Rental routes for customers
Route::middleware(['auth', 'rolemanager:customer'])->group(function () {
    Route::get('/rentals/{car_id}/book', [RentalController::class, 'book'])->name('rentals.book.form');
    Route::get('/rentals/dashboard', action: [RentalController::class, 'index'])->name('rentals.dashboard');
    Route::post('/rentals/{car_id}/book', [RentalController::class, 'store'])->name('rentals.book');
    Route::get('/rentals/{id}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');

});

// Owner Dashboard Routes
Route::middleware(['auth', 'rolemanager:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/cars/create', [OwnerDashboardController::class, 'create'])->name('owner.cars.create');
    Route::post('/owner/cars', [OwnerDashboardController::class, 'store'])->name('owner.cars.store');
    Route::put('/owner/cars/{car}', [OwnerDashboardController::class, 'update'])->name('owner.cars.update');
    Route::delete('/owner/cars/{car}', [OwnerDashboardController::class, 'destroy'])->name('owner.cars.destroy');
});

// Fleet Provider Dashboard Routes
Route::middleware(['auth', 'rolemanager:fleet_provider'])->group(function () {
    Route::get('/fleet/dashboard', [FleetProviderDashboardController::class, 'index'])->name('fleet.dashboard');
    Route::get('/fleet/cars/create', [FleetProviderDashboardController::class, 'create'])->name('fleet.cars.create');
    Route::get('/fleet/cars/{car}', [FleetProviderDashboardController::class, 'carDetails'])->name('fleet.cars.details');
    Route::get('/fleet/cars/{car}/edit', [FleetProviderDashboardController::class, 'edit'])->name('fleet.cars.edit');
    Route::post('/fleet/cars', [FleetProviderDashboardController::class, 'store'])->name('fleet.cars.store');
    Route::put('/fleet/cars/{car}', [FleetProviderDashboardController::class, 'update'])->name('fleet.cars.update');
    Route::put('/fleet/cars/{car}/availability', [FleetProviderDashboardController::class, 'updateAvailability'])->name('fleet.cars.updateAvailability');
    Route::delete('/fleet/cars/{car}', [FleetProviderDashboardController::class, 'destroy'])->name('fleet.cars.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
