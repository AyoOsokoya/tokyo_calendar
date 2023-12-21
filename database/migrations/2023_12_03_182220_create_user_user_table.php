<?php

declare(strict_types=1);

use App\Domains\Users\Models\Tables\TableUserUser as _;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(_::table_name, function (Blueprint $table) {
            $table->id();
            $table->integer(_::user_id)->index();
            $table->integer(_::relation_id)->index();
            $table->string(_::user_user_status)->index();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(_::table_name);
    }
};
