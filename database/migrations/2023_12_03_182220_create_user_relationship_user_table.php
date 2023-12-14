<?php
declare(strict_types=1);

use App\Domains\Users\Models\UserRelationshipToUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(UserRelationshipToUser::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('relation_id')->index();
            $table->string('user_relationship_status')->index(); // FOLLOW, UNFOLLOW // later BLOCKED, MUTUAL, MUTED
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
