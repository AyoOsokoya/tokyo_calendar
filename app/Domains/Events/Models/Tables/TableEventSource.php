<?php
declare(strict_types=1);

namespace App\Domains\Events\Models\Tables;

class TableEventSource
{
    const table_name = 'event_sources';
    const id = 'id';
    const name_display = 'name_display';
    const name_display_short = 'name_display_short';
    const name_importer = 'name_importer';
    const event_source = 'event_source';
    const event_source_data_type = 'event_source_data_type';
    const command_name = 'command_name';
    const command_parameters = 'command_parameters';
    const base_url = 'base_url';

}
