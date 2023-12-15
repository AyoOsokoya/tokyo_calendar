<?php

declare(strict_types=1);

use App\Domains\Events\Models\Tables\TableEventSource as _;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(_::table_name, function (Blueprint $table) {
            $table->id();
            $table->string(_::name_display);
            $table->string(_::name_display_short);
            $table->string(_::name_importer)->unique();
            $table->string(_::event_source_data_type);
            $table->string(_::command_name)->nullable(); // Command to run, if no command name, do nothing
            $table->string(_::command_parameters)->nullable(); // Command to run
            $table->string(_::base_url)->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(_::table_name);
    }
};
