<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments("task_id");
            $table->string("task_name");
            $table->string("discription");
            $table->unsignedInteger('genre_id');
            $table->foreign('genre_id')->references('genre_id')->on('genres');
            $table->unsignedInteger('difficulty_id');
            $table->foreign('difficulty_id')->references('difficulty_id')->on('difficulties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}