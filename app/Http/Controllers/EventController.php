<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Enums\EnumApiResponseFormat;
use App\Enums\EnumEventUserAttendanceStatus;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class EventController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    public function userEvents(
        ?EnumApiResponseFormat $response_format = EnumApiResponseFormat::JSON
    ): JsonResponse|Response {
        // $user = Auth::user();
        $user = User::first();

        $events = $user->events()
            ->with('event_source')
            ->with('users')
            ->orderBy('id')
            ->get();

        return response()->jsonIcalResponse($events, $response_format);
    }
    public function allEvents(
        ?EnumApiResponseFormat $response_format = EnumApiResponseFormat::JSON
    ) : JsonResponse|Response {
        $events = Event::with('source')
            ->orderBy('starts_at')
            ->get();

        return response()->jsonIcalResponse($events, $response_format);
    }

    public function userEventsByAttendanceStatus(
        EnumEventUserAttendanceStatus $attendance_status,
        ?EnumApiResponseFormat $response_format = EnumApiResponseFormat::JSON
    ): JsonResponse|Response
    {
        // $user = Auth::user();
        $user = User::first();

        $events = $user->events()
            ->with('event_source')
            ->wherePivot('user_event_attendance_status', $attendance_status)
            ->get();

        return response()->jsonIcalResponse($events, $response_format);
    }
}
