<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;
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

Route::get('user',[UserController::class, 'index'])->name('user.index');
Route::get('user/create',[UserController::class, 'create'])->name('user.create');
Route::post('user',[UserController::class, 'store'])->name('user.store');
Route::get('user/{id}',[UserController::class, 'show'])->name('user.show')->middleware('user');
Route::get('user/{id}/edit',[UserController::class, 'edit'])->name('user.edit');
Route::put('user/{id}',[UserController::class, 'update'])->name('user.update');
Route::delete('user/{id}',[UserController::class, 'destroy'])->name('user.destroy');

Route::get('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register']);
Route::view('not_found', 'user_not_found');
Route::view('found', 'welcome');

// Route::get('token',[TokenController::class, 'index'])->name('token.index');
// Route::get('token/create',[TokenController::class, 'create'])->name('token.create');
// Route::post('token',[TokenController::class, 'store'])->name('token.store');
Route::get('token/{id}',[TokenController::class, 'show'])->name('token.show');
// Route::put('token/{id}',[TokenController::class, 'update'])->name('token.update');
// Route::delete('token/{id}',[TokenController::class, 'destroy'])->name('token.destroy');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
