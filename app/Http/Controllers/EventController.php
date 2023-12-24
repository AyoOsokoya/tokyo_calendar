<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Events\Models\Event;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Enums\EnumApiResponseFormat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;

class EventController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    public function event(): void
    {
        // check permissions
        // return event data if exists
    }

    public function createEvent(): void
    {
        // Validate Data
        // return appropriate error if validation fails
        // Save
        // return appropriate error if save fails
        // Return OK status code
    }

    public function updateEvent(): void
    {
        // Validate Data
        // return appropriate error if validation fails
        // Save
        // return appropriate error if save fails
        // Return OK status code
    }

    public function deleteEvent(): void
    {
        // Check permissions
        // self delete or admin delete is okay
        // return appropriate error if delete fails
        // Return OK status code
    }

    public function userEvents(
        ?EnumApiResponseFormat $response_format = EnumApiResponseFormat::JSON
    ): JsonResponse|Response {

        // TODO: move to scope
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
    ): JsonResponse|Response {

        //TODO: move to scope
        $events = Event::with('event_source')
            // ->where('event_source_id', '!=', '2')
            ->whereDate('starts_at', '>=', Carbon::now())
            ->orderBy('starts_at')
            ->get();

        return response()->jsonIcalResponse($events, $response_format);
    }

    public function userEventsByAttendanceStatus(
        EnumUserEventAttendanceStatus $attendance_status,
        ?EnumApiResponseFormat $response_format = EnumApiResponseFormat::JSON
    ): JsonResponse|Response {
        // $user = Auth::user();
        $user = User::first();

        // TODO: move to scope
        $events = $user->events()
            ->with('event_source')
            ->wherePivot('user_event_attendance_status', $attendance_status)
            ->get();

        return response()->jsonIcalResponse($events, $response_format);
    }
}
