<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileNumberYearAndFileNumberSerialToContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->year('file_number_year')->nullable()->after('results_published_at');
            $table->smallInteger('file_number_serial')->nullable()->after('file_number_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('file_number_year');
            $table->dropColumn('file_number_serial');
        });
    }
}
