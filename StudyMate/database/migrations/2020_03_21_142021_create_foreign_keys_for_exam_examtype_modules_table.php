<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysForExamExamtypeModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('CASCADE');
            $table->foreign('examtype_id')->references('id')->on('exam_types')->onDelete('CASCADE');
        });

        Schema::table('exam_tags', function (Blueprint $table){
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('CASCADE');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys_for_exam_examtype_modules');
    }
}
