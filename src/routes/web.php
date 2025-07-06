<?php

use App\Http\Controllers\ConfirmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ConfirmController::class, 'index'])->name('index');
Route::post('contacts/confirm', [ConfirmController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts', [ConfirmController::class, 'store'])->name('contacts.store');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.custom');

Route::get('/admin', [AdminController::class, 'search'])->middleware('auth');
Route::get('/search', [AdminController::class, 'search']);
Route::get('/export', [AdminController::class, 'export']);
Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('contacts.destroy');
