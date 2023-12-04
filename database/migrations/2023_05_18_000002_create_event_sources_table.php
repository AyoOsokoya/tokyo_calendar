<?php
declare(strict_types = 1);

use App\Domains\Events\Models\EventSource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(EventSource::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('name_display');
            $table->string('name_display_short');
            $table->string('name_importer')->unique();
            $table->string('event_source_data_type');
            $table->string('command_name')->nullable(); // Command to run, if no command name, do nothing
            $table->string('command_parameters')->nullable(); // Command to run
            $table->string('base_url')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
