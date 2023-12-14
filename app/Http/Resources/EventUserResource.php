<?php
declare(strict_types = 1);

namespace App\Http\Resources;

use App\Domains\Users\Models\UserEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserEvent
 */
class EventUserResource extends JsonResource
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
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)) ,
            'event' => $this->whenLoaded('event',fn() => new EventResource($this->event)),
        ];
    }

}
