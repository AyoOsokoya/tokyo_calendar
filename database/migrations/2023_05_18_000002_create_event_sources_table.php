<?php
declare(strict_types = 1);

use App\Models\EventSource;
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
        Schema::create(app(EventSource::class)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name_display');
            $table->string('name_importer')->unique();
            $table->string('event_source');
            $table->string('event_source_data_type');
            $table->string('command_name'); // Command to run
            $table->string('command_parameters'); // Command to run
            $table->string('base_url');
            $table->string('email');
            $table->string('phone_number');
            $table->datetimes();
            $table->softDeletesDatetime();
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
