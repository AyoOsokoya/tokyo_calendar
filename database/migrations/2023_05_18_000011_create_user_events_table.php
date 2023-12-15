<?php
declare(strict_types=1);

use App\Domains\Users\Models\UserEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Domains\Users\Models\Tables\TableUserEvent as _;

return new class extends Migration {

    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(UserEvent::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->unsignedInteger(_::inviter_id)->index();
            $table->unsignedInteger(_::event_id)->index();
            $table->unsignedInteger(_::user_id)->index();
            $table->string(_::user_event_role_type)->index();
            $table->string(_::user_event_attendance_status)->index();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
