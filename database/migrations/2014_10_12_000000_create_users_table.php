<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('lastname', 30);
            $table->string('firstname');
            $table->string('middlename', 30)->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->boolean('_isActive')->default(0);
            $table->boolean('_isAdmin')->default(0);
            $table->text('_img')->nullable()->default('img/users/user-icon.png');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
