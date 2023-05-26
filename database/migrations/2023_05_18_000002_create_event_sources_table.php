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
        Schema::create('event_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('event_source_enum');
            $table->string('handle')->unique();
            $table->string('data_type'); // RSS/iCal/
            $table->string('command_name'); // Command to run
            $table->string('command_parameters'); // Command to run
            $table->string('base_url');
            $table->string('email');
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_sources');
    }
};
