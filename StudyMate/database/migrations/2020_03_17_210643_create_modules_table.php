<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('overseer');
            $table->unsignedBigInteger('taught_by');
            $table->unsignedBigInteger('followed_by')->nullable();
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('period_id');
            $table->date('year');
            $table->integer('study_points');
            $table->boolean('is_finished');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
