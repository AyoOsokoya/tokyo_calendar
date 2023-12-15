<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Location\Models\Tables\TableLocation as _;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(_::table_name, function (Blueprint $table) {
            $table->id();
            $table->string(_::country); // iso 3166-1 alpha-3
            $table->string(_::city);
            $table->string(_::state);
            $table->string(_::street_address);
            $table->string(_::post_code);
            $table->string(_::other);

            // TODO: consider using spacialIndex for coordinates
            $table->double(_::longitude);
            $table->double(_::latitude);

            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(_::table_name);
    }
};
