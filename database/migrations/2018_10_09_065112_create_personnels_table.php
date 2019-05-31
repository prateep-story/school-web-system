<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('category');
            $table->string('position');
            $table->string('accredit')->nullable(true);
            $table->string('degree');
            $table->string('qualification')->nullable(true);
            $table->string('major')->nullable(true);
            $table->string('tel')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('image')->default('personnel.jpg');
            $table->integer('department_id')->unsigned()->nullable(true);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('department_level')->nullable(true);
            $table->string('responsible')->nullable(true);
            $table->integer('course_id')->unsigned()->nullable(true);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('course_level')->nullable(true);
            $table->string('teach')->nullable(true);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug');
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
        Schema::dropIfExists('personnels');
    }
}
