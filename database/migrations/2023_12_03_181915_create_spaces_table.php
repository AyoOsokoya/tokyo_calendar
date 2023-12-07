<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Spaces\Models\Space;

// TODO: Figure out how to store addresses in the database.
/*
 https://www.google.com/search?q=storing+address+in+database&oq=storing+address+in+database&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIGCAEQLhhA0gEINTQwN2owajGoAgCwAgA&sourceid=chrome&ie=UTF-8
 https://stackoverflow.com/questions/310540/best-practices-for-storing-postal-addresses-in-a-database-rdbms
 https://www.reddit.com/r/PostgreSQL/comments/glz3ik/how_do_you_model_your_database_to_store_addresses/
 https://softwareengineering.stackexchange.com/questions/357900/whats-a-universal-way-to-store-a-geographical-address-location-in-a-database
 */

return new class extends Migration {
    private string $table_name;

    public function __construct()
    {
        $this->table_name = app(Space::class)->getTable();
    }

    // Address format from
    // https://softwareengineering.stackexchange.com/questions/357900/whats-a-universal-way-to-store-a-geographical-address-location-in-a-database
    // https://github.com/google/libaddressinput consider this for validating addresses

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->json('socials_json')->nullable();
            $table->string('schedule_text')->nullable();
            $table->json('gallery_json')->nullable();
            $table->string('url')->nullable();
            $table->string('space_type')->index();
            $table->string('location')->nullable();
            $table->string('coordinates')->nullable();

            $table->string('country')->nullable();
            $table->string('postcode')->nullable(); // post/zip code
            $table->string('state')->nullable(); // state/province/prefecture/county
            $table->string('city')->nullable(); // city/town/village
            $table->string('street')->nullable(); // street/road/block
            $table->string('building_name_number')->nullable(); // building name/number
            $table->string('custom')->nullable(); // specific/custom information

            $table->string('parent_space_id')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};
