<?php

declare(strict_types=1);

namespace App\Domains\Location\Actions;

use App\Domains\Location\Models\Location;

class LocationActionDelete
{
    private Location $location;

    private function __construct(Location $location)
    {
        $this->location = $location;
    }

    public static function make(Location $location): LocationActionDelete
    {
        return new LocationActionDelete($location);
    }

    public function execute(): void
    {
        // TODO: Detach events from location
        // TODO: Detach spaces from location
        $this->location->delete();
    }
}
