<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MainPageController;

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

Route::get('/', [MainPageController::class, 'index'])->name('main');
Route::post('ticket/create', [TicketController::class, 'submit'])->name('create-ticket');

Auth::routes();

//profiles & backoffice
Route::group(['middleware' => 'auth'], function () {
    Route::get('/customer', [ProfileController::class, 'index'])
        ->name('customer');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('/account', [ProfileController::class, 'account'])
        ->name('account');

    Route::resource('my-tickets', AdminTicketController::class);

    //admin
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
//        Route::get('/', function(){
//            return view('layouts.dashboard');
//        });
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('tickets', AdminTicketController::class);
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
