<?php
declare(strict_types = 1);

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(app(Event::class)->getTable(), function (Blueprint $table) { // change to use class table_name
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('location');
            $table->dateTime('starts_at')->index();
            $table->dateTime('ends_at')->index();
            $table->string('url');
            $table->string('event_status');
            $table->integer('event_gallery_id')->index();
            $table->integer('event_source_id')->index();
            $table->integer('event_creator_id')->index();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
