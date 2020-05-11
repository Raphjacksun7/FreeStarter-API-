<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('projects_id');
            $table->foreign('projects_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');
            $table->string('isValidEmail')->default(false);
            $table->string('realName')->nullable();
            $table->string('nameOfBank')->nullable();
            $table->string('bankAccountNumber')->nullable();
            $table->string('RIB')->nullable();
            $table->string('status')->nullable();
            $table->string('statusProof')->nullable();
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
        Schema::dropIfExists('bank_status');
    }
}
