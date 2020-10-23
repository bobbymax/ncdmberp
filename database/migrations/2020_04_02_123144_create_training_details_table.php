<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('training_id')->unsigned();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->bigInteger('qualification_id')->default(0);
            $table->bigInteger('course_id')->default(0);

            $table->string('vendor')->nullable();
            $table->string('resident')->default('local');
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('sponsor')->default('ncdmb');
            $table->string('certificate')->nullable();
            $table->string('status')->default('archived'); 
            $table->string('action')->default('pending'); // pending, line-manager-approved / declined, approved
            $table->string('amount')->nullable();
            $table->boolean('categorised')->default(false);
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('training_details');
    }
}
