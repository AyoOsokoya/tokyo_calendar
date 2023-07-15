<?php
declare(strict_types = 1);

namespace Database\Factories;

use Hamcrest\Core\Set;
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

Route::prefix('/v1')
    ->group(function () {
    Route::get('/events/', [EventController::class, 'allEvents']);
    Route::get('/user/events/{response_format?}', [EventController::class, 'userEvents']);
    Route::get('/user/events/attendance_status/{attendance_status}/{response_format?}',
        [EventController::class, 'userEventsByAttendanceStatus']
    );

    // Route::get('/user/events/now/', [EventController::class, '']);
    // Route::get('/user/events/recommended/', [EventController::class, '']);
    // Route::get('/user/events/weekend/', [EventController::class, '']);
    // Route::get('/user/events/history/', [EventController::class, '']);
    // Route::get('/user/events/soon/', [EventController::class, '']);
    // Route::get('/user/events/interest/soon/', [EventController::class, '']);
    // Route::get('/user/events/curious/', [EventController::class, '']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
