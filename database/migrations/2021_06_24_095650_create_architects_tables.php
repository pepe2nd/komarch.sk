<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchitectsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architects', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->char('gender', 1);
            $table->string('title_before', 50)->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title_after', 50)->nullable();
            $table->string('webpage')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('architect_id')->constrained();
            $table->string('location_country')->nullable();
            $table->string('location_district')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_street')->nullable();
            $table->string('location_register_number')->nullable();
            $table->string('location_descriptive_number')->nullable();
            $table->string('location_postal_code')->nullable();
            $table->float('location_lat', 10, 6)->nullable();
            $table->float('location_lng', 10, 6)->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('business_numbers', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('architect_id')->nullable()->constrained();
            $table->char('business_number', 10)->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->string('studio')->nullable();
            $table->timestamps();
        });

        Schema::create('numbers', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('architect_id')->constrained();
            $table->string('architect_number')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->timestamps();
        });

        Schema::create('architect_contest', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('contest_id')->constrained();
            $table->foreignId('architect_id')->constrained();
            $table->tinyInteger('depended')->nullable();
            $table->char('type', 1)->nullable();
        });

        Schema::create('architect_work', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('work_id')->nullable()->constrained();
            $table->foreignId('architect_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('architect_work');
        Schema::dropIfExists('architect_contest');
        Schema::dropIfExists('numbers');
        Schema::dropIfExists('business_numbers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('architects');
    }
}
