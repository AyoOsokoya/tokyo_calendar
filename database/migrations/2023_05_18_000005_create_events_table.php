<?php
declare(strict_types = 1);

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(app(Event::class)->getTable(), function (Blueprint $table) { // change to use class table_name
            $table->id();
            // Descriptors
            $table->string('name');
            $table->text('description')->nullable();
            // Location
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->text('address')->nullable();
            // Date and Time
            $table->dateTime('starts_at')->index();
            $table->dateTime('ends_at')->index();
            // Event data
            $table->integer('event_source_id')->index();
            $table->string('event_status');
            $table->string('url')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(Event::class)->getTable());
    }
};
