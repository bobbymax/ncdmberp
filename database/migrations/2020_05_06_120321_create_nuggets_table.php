<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuggetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuggets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('api_resource_id')->unsigned();
            $table->foreign('api_resource_id')->references('id')->on('api_resources')->onDelete('cascade');

            $table->string('key')->unique();
            $table->string('display_name')->nullable();
            $table->boolean('browse')->default(true);
            $table->boolean('read')->default(true);
            $table->boolean('edit')->default(false);
            $table->boolean('add')->default(false);
            $table->boolean('delete')->default(false);

            $table->boolean('deny')->default(false);            
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
        Schema::dropIfExists('nuggets');
    }
}
