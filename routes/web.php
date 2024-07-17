<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\purchaseController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);

   
    Route::post('/note',[UserController::class, 'notes'])->name('users.note');
    Route::post('/note',[RoleController::class, 'notes'])->name('roles.note');
    Route::post('/search',[ProductController::class, 'search'])->name('products.search');
    
    Route::get('soldindex',[InventoryController::class, 'index'])->name('soldindex');
    Route::get('soldcreate',[InventoryController::class, 'create'])->name('soldcreate');
    Route::post('soldstore',[InventoryController::class, 'store'])->name('soldstore');
    Route::post('soldsearch',[InventoryController::class, 'search'])->name('sold.search');
    Route::post('soldsearchstock',[InventoryController::class, 'searchstock'])->name('sold.searchstock');

    Route::get('purchaseindex',[purchaseController::class, 'index'])->name('purchaseindex');
    Route::get('purchasecreate',[purchaseController::class, 'create'])->name('purchasecreate');
    Route::post('purchasestore',[purchaseController::class, 'store'])->name('purchasestore');
    Route::post('purchasesearch',[purchaseController::class, 'search'])->name('purchase.search');
    Route::post('purchasesearchstock',[purchaseController::class, 'searchstock'])->name('purchase.searchstock');
});

require __DIR__.'/auth.php';
