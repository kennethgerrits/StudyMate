<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('deadline_date');
            $table->boolean('is_finished');
            $table->string('appendix')->nullable();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('examtype_id');

            $table->foreign('module_id')->references('id')->on('modules')->onDelete('CASCADE');
            $table->foreign('examtype_id')->references('id')->on('exam_types')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
