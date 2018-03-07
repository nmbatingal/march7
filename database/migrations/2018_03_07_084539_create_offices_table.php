<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('office_name');
            $table->char('acronym', 20);
            $table->integer('head_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('head_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('users', function($table) {
            $table->integer('office_id')->unsigned()->nullable()->after('mobile_number');
            $table->string('position')->nullable()->after('office_id');

            $table->foreign('office_id')->references('id')->on('offices')->onUpdate('cascade')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropForeign(['office_id']);
        });

        Schema::dropIfExists('offices');
    }
}
