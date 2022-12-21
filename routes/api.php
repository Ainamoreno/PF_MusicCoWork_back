<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Rooms
Route::get('/rooms', [RoomController::class, 'getAllRooms']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/room/{id}', [RoomController::class, 'reserveRoom']);
    Route::put('/reservation/{id}', [RoomController::class, 'cancelReservation']);
    Route::get('/reservations', [RoomController::class, 'myReservations']);
});




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'profile']);
});
