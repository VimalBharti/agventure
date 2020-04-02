<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('community_id')->unsigned()->nullable();
            $table->string('image');
            $table->string('title');
            $table->string('slug');
            $table->text('about');
            $table->string('date');
            $table->string('location');
            $table->string('fees');
            $table->string('highlightA')->nullable();
            $table->string('highlightB')->nullable();
            $table->string('highlightC')->nullable();
            $table->string('timming');
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
        Schema::dropIfExists('events');
    }
}
