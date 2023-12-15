<?php

namespace App\Console\Commands;

use App\Domains\Events\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetEventImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-event-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download image and rename according to the event_id and source_id';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $events = Event::get();

        /** @var Event $event */
        $events->each(function ($event) {
            if (Storage::exists($this->nameImage($event))) {
                return;
            }

            // bluenote has an invalid cert get_file_contents fails
            $image = $this->getFileIgnoreCertificates($event->url_image);
            echo $this->nameImage($event)."\n";
            Storage::put($this->nameImage($event), $image);
        });
    }

    private function getUrlExtension($url)
    {
        $path_without_query = parse_url($url)['path'];

        return pathinfo($path_without_query)['extension'];
    }

    private function nameImage(Event $event): string
    {
        $subdirectory = $event->event_source->name_importer;

        $filename = number_format(
            $event->id + 100000000000, // be careful of exceeding PHP_MAX_INT
            0,
            null,
            '_'
        );

        $extension = $this->getUrlExtension($event->url_image);
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        return "{$subdirectory}/{$filename}.{$extension}";
    }

    private function getFileIgnoreCertificates($url): string
    {
        // Bluenote gives invalid certificate error and also prevents hotlinking to images
        // It will return a 403. It might be better to get images using Scrapy
        // file_get_contents($url) will simply crash out
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
