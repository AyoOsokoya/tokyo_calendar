<?php

declare(strict_types=1);

use App\Domains\Events\Models\Tables\TableEvent as _;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(_::table_name, function (Blueprint $table) {
            $table->id();
            // Descriptors
            $table->text(_::name); // some names are  very long
            $table->text(_::description)->nullable();

            $table->unsignedBigInteger(_::space_id)->nullable();

            // Date and Time
            $table->dateTime(_::starts_at)->index();
            $table->dateTime(_::ends_at)->index();
            $table->string(_::event_status)->index();
            $table->json(_::gallery_json)->nullable();
            $table->string(_::url)->nullable();
            $table->string(_::url_cover_image)->nullable();

            $table->string(_::event_category)->index();

            $table->integer(_::event_source_id)->index();
            $table->string(_::import_unique_id)->unique()->index();
            $table->string(_::import_data_hash)->index();

            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(_::table_name);
    }
};
