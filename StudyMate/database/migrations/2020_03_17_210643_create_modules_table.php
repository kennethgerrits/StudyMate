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
            $table->unsignedBigInteger('taught_by')->nullable();
            $table->unsignedBigInteger('followed_by')->nullable();
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('period_id');
            $table->integer('study_points');
            $table->boolean('is_finished');
            $table->foreign('followed_by')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('CASCADE');
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('CASCADE');
            $table->foreign('overseer')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('taught_by')->references('id')->on('users')->onDelete('CASCADE');

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
