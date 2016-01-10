<?php

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
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('country');
            $table->string('stage_name')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('type');
            $table->string('email')->unique()->nullable();
            $table->string('password', 60);
            $table->integer('role_id')->unsigned()->nullable();
            $table->boolean('is_artist')->default(false);
            $table->timestamp('is_artist_on')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
