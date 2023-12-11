<?php

use App\Domains\Location\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table_name;
    public function __construct()
    {
        $this->table_name = app(Location::class)->getTable();
    }

    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->id();
            $table->string('country'); // iso 3166-1 alpha-3
            $table->string('city');
            $table->string('street_address');
            $table->string('post_code');
            $table->string('state_province');
            $table->string('other');
            
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }
};