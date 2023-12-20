<?php

declare(strict_types=1);

use App\Domains\Spaces\Models\Tables\TableSpace as _;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// TODO: Figure out how to store addresses in the database.
/*
 https://www.google.com/search?q=storing+address+in+database&oq=storing+address+in+database&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIGCAEQLhhA0gEINTQwN2owajGoAgCwAgA&sourceid=chrome&ie=UTF-8
 https://stackoverflow.com/questions/310540/best-practices-for-storing-postal-addresses-in-a-database-rdbms
 https://www.reddit.com/r/PostgreSQL/comments/glz3ik/how_do_you_model_your_database_to_store_addresses/
 https://softwareengineering.stackexchange.com/questions/357900/whats-a-universal-way-to-store-a-geographical-address-location-in-a-database
 */

return new class extends Migration
{
    // Address format from
    // https://softwareengineering.stackexchange.com/questions/357900/whats-a-universal-way-to-store-a-geographical-address-location-in-a-database
    // https://github.com/google/libaddressinput consider this for validating addresses

    public function up(): void
    {
        Schema::create(_::table_name, function (Blueprint $table) {
            $table->id();
            $table->string(_::name);
            $table->string(_::description)->nullable();
            $table->json(_::socials_json)->nullable();
            $table->string(_::schedule_text)->nullable();
            $table->json(_::gallery_json)->nullable();
            $table->string(_::website_url)->nullable();
            $table->string(_::location_id)->index()->nullable();
            $table->string(_::space_activity_status)->index();
            $table->string(_::space_verification_status)->index();

            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(_::table_name);
    }
};
