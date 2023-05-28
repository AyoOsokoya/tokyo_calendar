<?php
declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(app(User::class)->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('name_first');
            $table->string('name_last')->nullable();
            $table->string('name_middle')->nullable();
            $table->string('name_handle');
            $table->integer('age')->nullable();
            $table->string('user_type');
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(app(User::class)->getTable());
    }
};
