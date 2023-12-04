<?php
declare(strict_types = 1);

use App\Models\EventUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(EventUser::class)->getTable();
    }
    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->primary(['user_id', 'event_id']);
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('event_id')->index();
            $table->unsignedInteger('inviter_id')->index()->nullable();
            $table->string('relation_type')->index();
            $table->dateTime('starts_at')->index()->nullable();
            $table->dateTime('ends_at')->index()->nullable();
            $table->string('user_event_attendance_status')->index();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
