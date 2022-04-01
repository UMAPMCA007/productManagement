<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/',[DashBoardController::class,'index'])->name('dashboard');
Route::get('/brand',[DashBoardController::class,'brand'])->name('viewBrand');
Route::post('/create_brand',[DashBoardController::class,'CreateB'])->name('createB');
Route::get('/remove_brand/{id}',[DashBoardController::class,'removeB'])->name('removeB');
Route::post('/brandData',[DashBoardController::class,'BrandData'])->name('brandData');
Route::post('editBrand/{id}',[DashBoardController::class,'EditBrand'])->name('EditBrand');
//product routes
Route::get('/products',[ProductController::class,'product'])->name('viewProduct');
Route::post('/create_product',[ProductController::class,'CreateP'])->name('createP');
Route::get('/remove_product/{id}',[ProductController::class,'removeP'])->name('removeP');
Route::post('/productData',[ProductController::class,'ProductData'])->name('productData');
Route::post('editProduct/{id}',[ProductController::class,'EditProduct'])->name('EditProduct');
