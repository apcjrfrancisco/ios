<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


//Frontend
Route::controller(FrontendController::class)->group(function(){
    Route::get('/', 'Index')->name('index'); 
    Route::get('/categories', 'Categories')->name('categories');
    Route::get('/categories/{category_slug}', 'Products')->name('products');
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
    Route::get('/unit/add', 'UnitAdd')->name('unit.add');
    Route::post('/unit/store', 'UnitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
    Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
    Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');

});

//Category
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/all', 'CategoryAll')->name('category.all');
    Route::get('/category/add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');

});

//Brands
Route::controller(BrandController::class)->group(function(){
    Route::get('/brand/all', 'BrandAll')->name('brand.all');
    Route::get('/brand/add', 'BrandAdd')->name('brand.add');
    Route::post('/brand/store', 'BrandStore')->name('brand.store');
    Route::get('/brand/edit/{id}', 'BrandEdit')->name('brand.edit');
    Route::post('/brand/update', 'BrandUpdate')->name('brand.update');
    Route::get('/brand/delete/{id}', 'BrandDelete')->name('brand.delete');

});

//Products
Route::controller(ProductController::class)->group(function(){
    Route::get('/product/all', 'ProductAll')->name('product.all');
    Route::get('/product/add', 'ProductAdd')->name('product.add');
    Route::post('/product/store', 'ProductStore')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
    Route::post('/product/update', 'ProductUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');


});
//Purchase
Route::controller(PurchaseController::class)->group(function(){
    Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
    Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
    Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
    Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
    Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');

});

//Defaults
Route::controller(DefaultController::class)->group(function(){
    Route::get('/get-brand', 'GetBrand')->name('get-brand'); 
    Route::get('/get-category', 'GetCategory')->name('get-category'); 
    Route::get('/get-product', 'GetProduct')->name('get-product'); 
});

//Slider
Route::controller(SliderController::class)->group(function(){
    Route::get('/slider/all', 'SliderAll')->name('slider.all');
    Route::get('/slider/add', 'SliderAdd')->name('slider.add');
    Route::post('/slider/store', 'SliderStore')->name('slider.store');
    Route::get('/slider/edit/{id}', 'SliderEdit')->name('slider.edit');
    Route::post('/slider/update', 'SliderUpdate')->name('slider.update');
    Route::get('/slider/delete/{id}', 'SliderDelete')->name('slider.delete');

});

