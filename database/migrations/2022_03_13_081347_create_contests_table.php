<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('owner')->nullable();
            $table->string('type')->nullable();
            $table->string('place')->nullable();


            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();

            $table->string('freez_time')->nullable();
            $table->string('unfreez_time')->nullable();

            $table->string('reg_start_time')->nullable();
            $table->string('reg_end_time')->nullable();

            $table->integer('problems')->nullable();
            $table->string('status');

            $table->string('registration')->nullable();
            $table->integer('contestants')->nullable();
            $table->text('description')->nullable();
            $table->string('creator')->nullable();
            $table->string('logo')->nullable();
            $table->string('officials')->nullable();
            $table->string('sponsers')->nullable();
            $table->string('sponserslogo')->nullable();

            $table->integer('winners')->nullable();


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
        Schema::dropIfExists('contests');
    }
}
