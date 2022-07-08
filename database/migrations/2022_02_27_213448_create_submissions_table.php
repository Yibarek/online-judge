<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('problem');
            $table->String('language');
            $table->timestamp('date')->useCurent();
            $table->String('verdict');
            $table->String('cpu_time');
            $table->integer('memory');
            $table->integer('contest');
            $table->string('visibility');
            $table->string('minute')->nullable();
            $table->string('p_in_s')->nullable();
            $table->string('stop_at')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
