<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->change();
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->string('name')->nullable();

            $table->timestamps();
        });

        Schema::create('award_work', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->foreignId('work_id')->nullable()->constrained();
            $table->foreignId('award_id')->nullable()->constrained();
            $table->year('year')->nullable();
            $table->boolean('nomination')->nullable(false);
            $table->boolean('winning')->nullable(false);

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
        Schema::dropIfExists('award_work');
        Schema::dropIfExists('awards');

        Schema::table('works', function (Blueprint $table) {
            $table->bigInteger('id')->change();
        });
    }
}
