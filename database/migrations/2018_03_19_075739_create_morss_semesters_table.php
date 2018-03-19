<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMorssSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morss_semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month_from')->unsigned();
            $table->integer('month_to')->unsigned();
            $table->char('year', 4);
            $table->timestamps();

            $table->unique(['month_from', 'month_to', 'year']);

            $table->foreign('month_from')->references('id')->on('table_month')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('month_to')->references('id')->on('table_month')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('morss_semesters');
    }
}
