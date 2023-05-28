<?php
declare(strict_types = 1);

use App\Models\EventUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(app(EventUser::class)->getTable(), function (Blueprint $table) {
            $table->primary(['user_id', 'event_id']);
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('event_id')->index();
            $table->string('user_event_attendance_status')->index();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(EventUser::class)->getTable());
    }
};
