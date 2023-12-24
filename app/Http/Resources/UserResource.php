<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends JsonResource
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
            'events' => $this->whenLoaded('events', fn () => new EventResource($this->events)),
            'pivot' => $this->whenPivotLoaded('event_user', fn () => new EventUserResource($this->pivot)),
        ];
    }
}
