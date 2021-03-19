<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::get('/user', function (Request $request) {
 //   $result = DB::table('users')->where('email','=',$email)
    return $request->input('username');
}); */

Route::get('/user', [ApiController::class, 'user']);
Route::get('/products', [ApiController::class, 'products']);
Route::get('/category', [ApiController::class, 'category']);
Route::get('/sales', [ApiController::class, 'sales']);
