<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClarificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clarifications', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->string('reciever');
            $table->string('content');
            $table->string('sender_status')->nullable();
            $table->string('reciever_status')->nullable();
            $table->string('contest');
            $table->string('time');
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
        Schema::dropIfExists('clarifications');
    }
}
