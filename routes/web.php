<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index']);
});

//Supplier
Route::controller(SupplierController::class)->group(function(){
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');

});

//Unit
Route::controller(UnitController::class)->group(function(){
    Route::get('/unit/all', 'UnitAll')->name('unit.all');
    // Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
    // Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    // Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    // Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
    // Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');

});