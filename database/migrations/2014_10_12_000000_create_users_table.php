<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('role');
            $table->string('email')->unique();
            $table->bigInteger('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rating')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('college')->nullable();
            $table->string('organization')->nullable();
            $table->string('department')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('team')->nullable();
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
        Schema::dropIfExists('users');
    }
}
