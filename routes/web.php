<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LaporanKinerjaController;

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
    Route::get('/profile/{id}/index', [ProfileController::class, 'index']);
    Route::get('/profile/{id}/settings', [ProfileController::class, 'setting']);
    Route::put('/profile/{id}/settings', [ProfileController::class, 'change']);
    Route::resource('reports', LaporanKinerjaController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::post('/importjabatan', [JabatanController::class, 'importjabatan']);

    Route::get('/summary', [SummaryController::class, 'summary']);
    Route::get('/report', [SummaryController::class, 'report']);
    Route::get('/review', [SummaryController::class, 'review']);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);
