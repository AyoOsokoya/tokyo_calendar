<?php

declare(strict_types=1);

use App\Domains\Users\Models\Tables\TableUser as _;
use App\Domains\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(User::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string(_::name_first);
            $table->string(_::name_last)->nullable();
            $table->string(_::name_middle)->nullable();
            $table->string(_::name_handle);
            $table->string(_::avatar)->nullable();
            $table->datetime(_::date_of_birth)->nullable();
            $table->string(_::user_type);
            $table->string(_::account_status);
            $table->string(_::account_type);
            $table->string(_::email)->unique();
            $table->dateTime(_::email_verified_at)->nullable();
            $table->string(_::password);
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
