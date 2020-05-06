<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('label')->unique();
            $table->string('code')->unique();
            $table->integer('period_year')->default(0);
            $table->integer('duration')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('target')->default(0);
            $table->integer('progress')->default(0);
            $table->date('activation_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('tasks');
    }
}
