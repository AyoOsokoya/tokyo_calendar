<?php
declare(strict_types=1);

namespace App\Domains\Location\Models\Tables;

class TableLocation
{
    const table_name = 'locations';
    const id = 'id';
    const country = 'country';
    const city = 'city';
    const state = 'state';
    const street_address = 'street_address';
    const post_code = 'post_code';
    const other = 'other';

    const longitude = 'longitude';
    const latitude = 'latitude';
}
