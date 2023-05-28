<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // https://stackoverflow.com/questions/33410140/recurring-events-with-custom-data-on-each-event
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('starts_at');
            $table->integer('ends_at');
            $table->integer('duration');

            $table->integer('every_n_days')->nullable();

            $table->integer('every_n_weeks')->nullable(); // every 3 weeks, 1 weeks, 2 weeks.
            $table->integer('every_n_weeks_days')->nullable();
            $table->integer('every_n_weeks_days_ordinals')->nullable(); // first, second third, fourth , fifth, last

            $table->integer('every_n_months')->nullable();
            $table->integer('every_n_months_days_ordinal')->nullable(); // first, second third, fourth , fifth, last
            $table->integer('every_n_months_day_first')->nullable(); // first monday
            $table->integer('every_n_months_day_last')->nullable(); // last monday
            $table->integer('every_n_months_day')->nullable(); // Day ie: monday

            $table->integer('every_n_years')->nullable();
            $table->integer('every_n_years_months')->nullable();

            $table->integer('weekday')->nullable(); // monday, tuesday
            $table->integer('month_week')->nullable(); // 12345
            $table->integer('month_day')->nullable(); // 1, 2 ... 31
            $table->integer('year_date')->nullable(); // 25th January

            $table->string('schedule_type')->nullable(); // rule / rule_exclusion to rule ie but not on this day
            $table->string('parent_schedule_id')->nullable(); // base this rule on another existing rule

            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
