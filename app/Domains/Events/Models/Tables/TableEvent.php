<?php

declare(strict_types=1);

namespace App\Domains\Events\Models\Tables;

class TableEvent
{
    const table_name = 'events';

    const id = 'id';

    const name = 'name';

    const description = 'description';

    const space_id = 'space_id';

    const starts_at = 'starts_at';

    const ends_at = 'ends_at';

    const event_status = 'event_status';

    const gallery_json = 'gallery_json';

    const event_category = 'event_category';

    const url_cover_image = 'url_cover_image';

    const url = 'url';

    const event_source_id = 'event_source_id';

    const import_unique_id = 'import_unique_id';

    const import_data_hash = 'import_data_hash';
}
