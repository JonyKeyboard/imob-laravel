<?php

use App\Http\Controllers\Admin\AuthController;
// use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function(){

    // Formulário de login
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.do');

    // Rotas protegidas
    Route::group(['middleware' => ['auth']], function (){

        // Dashboard Home
        Route::get('home', [AuthController::class, 'home'])->name('home');

        Route::get('users/team', [\App\Http\Controllers\Admin\UserController::class, 'team'])->name('users.team');
        Route::resource('users', UserController::class);
    });

    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});
