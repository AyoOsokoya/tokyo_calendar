<?php
declare(strict_types = 1);

namespace App\Http\Resources;

use App\Domains\Events\Models\EventSource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin EventSource
 */
class EventSourceResource extends JsonResource
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
            'events' => $this->whenLoaded('events', fn() => EventResource::collection($this->events))
        ];
    }
}
