<?php

use App\Http\Controllers\AdditionalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryLetterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LaporanKinerjaController;
use App\Http\Controllers\MailingController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\PositionController;

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

Route::group(['middleware' => ['web','guest']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
});

Route::group(['middleware' => ['web','auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/profile/{id}/index', [ProfileController::class, 'index']);
    Route::get('/profile/{id}/settings', [ProfileController::class, 'setting']);
    Route::put('/profile/{id}/settings', [ProfileController::class, 'change']);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('reports', LaporanKinerjaController::class);
    Route::post('/positions/import', [PositionController::class, 'import'])->name('positions.import');
    Route::resource('positions', PositionController::class);
    Route::resource('outgoing-letters', OutgoingLetterController::class);
    Route::resource('entry-letters', EntryLetterController::class)->except('update');
    Route::delete('additionals/{additional}', [AdditionalController::class, 'destroy'])->name('additionals.destroy');

    Route::get('/surat-keluar', [MailingController::class, 'index']);
    Route::get('/compose', [MailingController::class, 'compose']);
    Route::get('/disposisi', [MailingController::class, 'inbox']);
    Route::get('/read-mail', [MailingController::class, 'detail']);

    Route::get('/summary', [SummaryController::class, 'summary']);
    Route::get('/report', [SummaryController::class, 'report']);
    Route::get('/review', [SummaryController::class, 'review']);
});
