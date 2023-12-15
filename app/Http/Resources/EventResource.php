<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Domains\Events\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Event
 */
class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'users' => $this->whenLoaded('users'), fn () => UserResource::collection($this->users),
            'event_source' => new EventSourceResource($this->whenLoaded('event_source')),
        ];
    }

    public function toIcalArray(Request $request): array
    {
        $starts_at = $this->whenPivotLoaded(
            'event_user',
            $this->pivot->starts_at,
            $this->starts_at
        );

        $ends_at = $this->whenPivotLoaded(
            'event_user',
            $this->pivot->ends_at,
            $this->ends_at
        );

        return [
            'name' => "{$this->event_source->name_display_short}: {$this->name}",
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            'description' => $this->description,
            'url' => $this->url,
        ];
    }
}
