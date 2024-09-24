<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    
    
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
