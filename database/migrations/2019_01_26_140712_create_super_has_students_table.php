<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperHasStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_has_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('super_id');
            $table->foreign('super_id')->references('id')->on('users');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('user_id')->on('arrivals');
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
        Schema::dropIfExists('super_has_students');
    }
}
