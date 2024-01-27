<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::group(['middleware' => ['web']], function () {

// });
// Auth::routes();
Route::group(['middleware' => ['web']], function () {

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('admin.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/users', [AdminController::class, 'users'])->name('users');
Route::get('/importUser', [AdminController::class, 'importUser'])->name('importUser');
Route::post('/importFile', [AdminController::class, 'importFile'])->name('importFile');

});

