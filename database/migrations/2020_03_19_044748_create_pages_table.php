<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');

            $table->string('name');
            $table->string('label')->unique();
            $table->string('icon')->nullable();
            $table->string('route')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->default('_self');
            $table->string('description')->nullable();
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('pages');
    }
}
