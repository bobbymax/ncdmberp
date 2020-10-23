<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_resources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->unique();
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->string('method')->default('GET');
            $table->boolean('hasParams')->default(false);
            $table->double('version')->default(1.0);
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('api_resources');
    }
}
