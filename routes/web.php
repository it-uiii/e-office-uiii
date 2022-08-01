<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UsersPortalController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users_portal', UsersPortalController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('visi_misi', VisiMisiController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('/category', CategoryController::class);
    Route::get('/profile/{id}/settings', [ProfileController::class, 'setting']);
    Route::put('/profile/{id}/settings', [ProfileController::class, 'change']);
    Route::resource('request', FormRequestController::class);
    Route::get('/mailbox', [InboxController::class, 'index']);

});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);

Route::resource('/services', ServiceController::class);
Route::get('/services/checkSlug', [ServiceController::class, 'checkSlug']);

Route::post('/logout', [LoginController::class, 'logout']);
