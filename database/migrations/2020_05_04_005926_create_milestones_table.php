<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

            $table->string('title');
            $table->string('label')->unique();
            $table->integer('duration')->default(1);
            $table->integer('weight')->default(0);
            $table->integer('progress')->default(0);

            $table->text('description')->nullable();
            $table->text('remark')->nullable();

            $table->longText('measurables')->nullable();
            $table->longText('deliverables')->nullable();
            $table->date('start_date')->nullable();
            $table->date('delivery_date')->nullable();

            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('milestones');
    }
}
