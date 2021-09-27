<?php

use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TicketTypeController;
use App\Http\Controllers\API\TicketStatusController;
use App\Http\Controllers\API\TicketPriorityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->resource('users', 'UserController');
Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('ticket-types', TicketTypeController::class);
Route::apiResource('ticket-status', TicketStatusController::class);
Route::apiResource('ticket-priority', TicketPriorityController::class);
Route::apiResource('teams', TeamController::class);
