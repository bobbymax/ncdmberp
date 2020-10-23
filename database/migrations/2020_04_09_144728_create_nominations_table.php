<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('training_detail_id')->unsigned();
            $table->foreign('training_detail_id')->references('id')->on('training_details')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->text('remark')->nullable();
            $table->string('flow')->default('manager');
            $table->string('state')->default('pending');
            $table->boolean('approval')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('instruction')->default(false);
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
        Schema::dropIfExists('nominations');
    }
}
