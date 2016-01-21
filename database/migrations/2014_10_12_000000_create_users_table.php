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
            $table->string('phone')->nullable();
//            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('country')->nullable();
            $table->string('stage_name')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('type');
            $table->string('email')->unique()->nullable();
            $table->string('password', 60);
            $table->integer('role_id')->unsigned()->nullable();
            $table->boolean('is_artist')->default(false)->nullable();
            $table->timestamp('artist_on')->nullable();
            $table->boolean('is_request_active')->nullable()->default(false);
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
