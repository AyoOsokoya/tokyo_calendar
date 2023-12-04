<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table_name;

    public function __construct()
    {
        $this->table_name = 'user_followers';
    }
    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('follower_id')->index();
            $table->string('follow_status')->index(); // request / accepted / blocked
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
