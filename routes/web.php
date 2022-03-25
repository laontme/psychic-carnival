<?php

use App\Http\Controllers\UserController;
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

Route::view('/', 'home')->name('home');

Route::name('user.')
    ->prefix('/user')
    ->controller(UserController::class)
    ->group(function () {
        Route::view('/login', 'user.login')->name('login.form');
        Route::post('/login', 'login')->name('login');

        Route::view('/register', 'user.register')->name('register.form');
        Route::post('/register', 'register')->name('register');

        Route::middleware('auth')
            ->group(function () {
                Route::view('/profile', 'user.profile')->name('profile');
                Route::get('/logout', 'logout')->name('logout');
            });
    });
