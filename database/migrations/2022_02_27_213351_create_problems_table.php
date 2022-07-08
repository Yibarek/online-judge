<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('solved')->unsigned()->nullable();
            $table->String('pdf_file')->nullable();
            $table->integer('testcase')->nullable();
            $table->String('output')->nullable();
            $table->integer('contest')->nullable();
            $table->integer('point')->nullable();
            $table->String('visibility')->nullable();
            $table->String('time_limit')->nullable();
            $table->String('memory_limit')->nullable();
            $table->String('p_in_s');
            $table->string('ballon_color')->nullable();
            $table->decimal('accepted_error')->nullable();
            $table->String('writter');
            $table->integer('firstsolved')->nullable();
            $table->timestamp('date')->useCurent();
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
        Schema::dropIfExists('problems');
    }
}
