<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitationPublications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citation_publications', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->string('publication_name')->nullable();
            $table->char('isbn', 13)->nullable();

            $table->timestamps();
        });

        Schema::create('citation_publication_work', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();

            $table->foreignId('work_id')->nullable()->constrained();
            $table->foreignId('publication_id')->nullable()->constrained('citation_publications');
            $table->string('source')->nullable();

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
        Schema::dropIfExists('citation_publication_work');
        Schema::dropIfExists('citation_publications');
    }
}
