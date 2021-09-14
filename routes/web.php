<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helpdesk\TicketController;
use App\Http\Controllers\IssueController;


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

Route::resource('issue', IssueController::class);

Route::get('/', function () {
    return view('main');
});

Route::post('helpdesk/ticket', [TicketController::class, 'submit'])->name('create-ticket');

Auth::routes();

//profiles & backoffice
Route::group(['middleware' => 'auth'], function() {
    Route::get('/customer', [ProfileController::class, 'index'])
        ->name('customer');
    Route::get('/logout', function() {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    //admin
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('users', UserController::class);
    });
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
