<?php
declare(strict_types = 1);

namespace Database\Seeders;

use App\Enums\EnumEventSourceDataType;
use App\Models\EventSource;
use Illuminate\Database\Seeder;

class EventSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $sources = collect([
            [
                'name_display' => 'timeout',
                'name_importer' => 'timeout',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.timeout.com/tokyo'
            ],
            [
                'name_display' => 'Meetup',
                'name_importer' => 'meetup',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.meetup.com/ja-JP/find/japan/'
            ],
            [
                'name_display' => 'GaijinPot',
                'name_importer' => 'gaijinpot',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://events.gaijinpot.com/'
            ],
            [
                'name_display' => 'TokyoCheapo',
                'name_importer' => 'tokyocheapo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://tokyocheapo.com'
            ],
            [
                'name_display' => 'GoTokyo',
                'name_importer' => 'gotokyo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.gotokyo.org/en/event-calendar/index.html'
            ],
            [
                'name_display' => 'TokyoGaijins',
                'name_importer' => 'tokyogaijins',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://tokyogaijins.com/upcoming/'
            ],
            [
                'name_display' => 'Japan Attractions',
                'name_importer' => 'japan_attractions',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://japan-attractions.jp/'
            ],
            [
                'name_display' => 'Yoyogi Koen',
                'name_importer' => 'yoyogi_koen',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => '' // Page is gone right now
            ],
            [
                'name_display' => 'Billboard Live Tokyo',
                'name_importer' => 'billboard_live_tokyo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'http://www.billboard-live.com/pg/shop/show/index.php?mode=calendar&shop=1'
            ],
            [
                'name_display' => 'Savvy Tokyo',
                'name_importer' => 'savvy_tokyo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://savvytokyo.com/'
            ],
            [
                'name_display' => 'Tokyo Weekender',
                'name_importer' => 'tokyo_weekender',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.tokyoweekender.com/'
            ],
            [
                'name_display' => 'Metropolis Japan',
                'name_importer' => 'metropolis_japan',
                'event_source_data_type' => EnumEventSourceDataType::ICAL,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://metropolisjapan.com/events/?ical=1&tribe_display=list'
            ],
            [
                'name_display' => 'Eventbrite Japan Tokyo',
                'name_importer' => 'eventbrite_japan_tokyo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.eventbrite.com/'
            ],
            [
                'name_display' => 'Bluenote Tokyo',
                'name_importer' => 'bluenote_tokyo',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://reserve.bluenote.co.jp/reserve/schedule/move/2'
            ],
            [
                'name_display' => 'Love Peace and Soul Bar Kyodo',
                'name_importer' => 'lovepeaceandsoul',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.lovepeaceandsoul.net/'
            ],
            [
                'name_display' => 'Craigslist Tokyo',
                'name_importer' => 'craigslist_tokyo',
                'event_source_data_type' => EnumEventSourceDataType::RSS, // SCRAPE
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://tokyo.craigslist.org/search/eve#search=1~list~0~0'
            ],
            [
                'name_display' => 'Tokyo Art Beat',
                'name_importer' => 'tokyoartbeat',
                'event_source_data_type' => EnumEventSourceDataType::SCRAPE, // SCRAPE
                'command_name' => '',
                'command_parameters' => '',
                'base_url' => 'https://www.tokyoartbeat.com/en/events/orderBy/latest'
            ],
        ]);

        $sources->each(fn ($source) => EventSource::create($source));
    }
}
