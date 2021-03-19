<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use Illuminate\Http\Request;



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
    return redirect('/register');   
});

Auth::routes();

Route::group([ 'middleware' => 'auth'], function()
{
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('index');
Route::post('/admin/addcat', [AdminController::class, 'store']);
Route::post('/admin/editcat/{id}', [AdminController::class, 'edit']);
Route::post('/admin/updatecat/{id}', [AdminController::class, 'update']);
Route::post('/admin/delcat/{id}', [AdminController::class, 'destroy']);

//Route::get('/emp', [HomeController::class, 'map'])->name('map');

Route::resource('products',ProductController::class);
Route::post('/products/store', [ProductController::class, 'store'])->name('product');
Route::post('/products/edit/{id}', [ProductController::class, 'edit']);
Route::post('/products/update/{id}', [ProductController::class, 'update']);
Route::post('/products/delete/{id}', [ProductController::class, 'destroy']);


Route::get('/emp/dashboard', [EmployerController::class, 'index'])->name('index');
Route::post('/emp/getcat', [EmployerController::class, 'getcat']);
Route::post('/emp/addsale', [EmployerController::class, 'store']);
Route::post('/emp/edit/{id}', [EmployerController::class, 'edit']);
Route::post('/emp/update/{id}', [EmployerController::class, 'update']);
Route::post('/emp/del/{id}', [EmployerController::class, 'destroy']);

});