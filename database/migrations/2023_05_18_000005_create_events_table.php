<?php

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
        Schema::create('events', function (Blueprint $table) { // change to use class table_name
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('event_html'); // the html of the event for later parsing
            $table->text('location');
            $table->dateTime('starts_at')->index();
            $table->dateTime('ends_at')->index();
            $table->boolean('is_repeated');
            $table->integer('event_gallery_id')->index();
            $table->integer('event_source_id')->index();
            $table->string('url');
            $table->string('phone_number');
            $table->integer('space_id')->index();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
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
