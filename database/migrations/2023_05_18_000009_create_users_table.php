<?php
declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(User::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('name_first');
            $table->string('name_last')->nullable();
            $table->string('name_middle')->nullable();
            $table->string('name_handle');
            $table->string('avatar')->nullable();
            $table->datetime('date_of_birth')->nullable();
            $table->string('user_type');
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
