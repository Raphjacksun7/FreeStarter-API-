<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projects_id');
            $table->foreign('projects_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');
            $table->string('localisation')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('slogan')->nullable();
            $table->longText('description')->nullable();
            $table->longText('target')->nullable();
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
        Schema::dropIfExists('project_details');
    }
}