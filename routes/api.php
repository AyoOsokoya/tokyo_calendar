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

Route::prefix('/v1')->group(function () {
    Route::get('/events/', [EventController::class, 'allEvents']);
    Route::get('/user/events/{response_format?}', [EventController::class, 'userEvents']);
    Route::get('/user/events/attendance_status/{attendance_status}/{response_format?}', [EventController::class, 'userEventsByAttendanceStatus'] );

    Route::prefix('/user')->group(function () {
        // /events/
        // /events/future
        // /events/history

        // /follow/{user_id}
        // /unfollow/{user_id}
        // /following
        // /followers

        // /space/follow/{space_id}
        // /space/unfollow/{space_id}

        // lists
        Route::prefix('/list')->group(function () {
            // /create
            // /update (add or remove people), change time etc
            // /view/{list_id}
            // /delete/{list_id}
            // /list/share_event/{list_id}/{event_id}
        });
        Route::get('lists', function () {
            return response()->json(['message' => 'Hello World!']);
        });
    });

    Route::prefix('/space')->group(function () {
        // /create
        // /update/{space_id}
        // /view/{space_id}
        // /delete/{space_id}
        // /user/remove/{space_id}
    });

    Route::prefix('/event')->group(function () {
        // /create
        // /update/{event_id}
        // /view/{event_id}
        // /delete/{event_id}
    });

    Route::get('/events', function () {
        return response()->json(['message' => 'Hello World!']);
        // now, recommended, weekend, history, soon, interest, curious
        // by category etc
        // search
    });

    Route::prefix('/community')->group(function () {
        // /create
        // /update/{community_id}
        // /view/{community_id}
        // /delete/{community_id}
        // /archive/{community_id}
        // /unarchive/{community_id}
        // /user/invite/{community_id}
        // /user/remove/{community_id}
    });
    Route::get('/communities', function () {
        return response()->json(['message' => 'Hello World!']);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

