<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Helpdesk\TicketController;

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
        \Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
