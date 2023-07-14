<?php
declare(strict_types = 1);

namespace Database\Factories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/v1')->group(function () {
    // all events
    //
    Route::get('/events/', [EventController::class, 'allEvents']);
    Route::get('/user/events/', [EventController::class, 'userEvents']);
    Route::get('/user/events/attendance_status/{attendance_status}', [EventController::class, 'userEventsByAttendanceStatus']);

    // Route::get('/user/events/now/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/recommended/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/weekend/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/history/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/soon/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/interest/soon/', [EventController::class, 'userEventsIcalFormat']);
    // Route::get('/user/events/curious/', [EventController::class, 'userEventsIcalFormat']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
