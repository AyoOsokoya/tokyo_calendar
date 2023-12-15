<?php

declare(strict_types=1);

namespace App\Domains\Location\Actions;

use App\Domains\Location\Models\Location;

class LocationActionUpdate
{
    private Location $location;

    private array $location_data;

    private function __construct($location, $location_data)
    {
        $this->location_data = $location_data;
        $this->location = $location;
    }

    public static function make(Location $location, array $location_data): LocationActionUpdate
    {
        return new LocationActionUpdate($location, $location_data);
    }

    public function execute(): void
    {
        $this->location->update($this->location_data);
    }
}
