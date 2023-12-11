<?php
declare(strict_types=1);

namespace App\Domains\Location\Actions;

use App\Domains\Location\Models\Location;

class LocationActionCreate
{
    private array $location_data;
    private function __construct($location_data)
    {
        $this->location_data = $location_data;
    }

    public static function make(array $location_data): LocationActionCreate
    {
        return new LocationActionCreate($location_data);
    }

    public function execute(): void
    {
        Location::create($this->location_data);
    }
}
