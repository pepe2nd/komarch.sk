<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTitleBeforeAndTitleAfterNullableOnArchitectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architects', function (Blueprint $table) {
            $table->string('title_before', 50)->nullable()->change();
            $table->string('title_after', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architects', function (Blueprint $table) {
                $table->string('title_before', 50)->nullable(false)->change();
                $table->string('title_after', 50)->nullable(false)->change();
        });
    }
}
