<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route:: get('products', [ProductController::class, 'index']);
Route:: get('product/{id}', [ProductController::class, 'show']);
Route:: post('product', [ProductController::class, 'store']);
Route:: put('product/{id}/update', [ProductController::class, 'update']);
Route:: delete('product/{id}/delete', [ProductController::class, 'destroy']);

Route::get('user', [UserController::class, 'random']);