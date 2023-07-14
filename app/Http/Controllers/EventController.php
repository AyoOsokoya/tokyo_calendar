<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Enums\EnumUserEventAttendanceStatus;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class EventController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    public function userEvents(): JsonResponse
    {
        // $user = Auth::user();
        $user = User::first();

        return response()->json($user->events()->get());
    }

    public function allEvents(): JsonResponse | Response
    {
        $events = Event::with('source')
            ->orderBy('starts_at')
            ->get();
        return response()->jsonICalResponse($events);
    }

    public function userEventsByAttendanceStatus(EnumUserEventAttendanceStatus $attendance_status): JsonResponse
    {
        $user = Auth::user();
        $user = User::first();

        $events = $user->events()
            ->wherePivot('user_event_attendance_status', 'going')
            ->get();
        return response()->json($events);
    }
}
