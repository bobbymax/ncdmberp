<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_no')->unique()->nullable()->after('id');
            $table->string('grade_level')->nullable()->after('staff_no');
            $table->string('mobile')->unique()->nullable()->after('email');
            $table->string('location')->default('opolo')->after('mobile');
            $table->string('type')->default('permanent')->after('location');
            $table->string('office_no')->nullable()->after('type');
            $table->string('avatar')->nullable()->after('office_no');
            $table->string('status')->default('available')->after('avatar');
            $table->date('date_joined')->nullable()->after('status');
            $table->boolean('active')->default(true)->after('date_joined');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('staff_no');
            $table->dropColumn('grade_level');
            $table->dropColumn('mobile');
            $table->dropColumn('location');
            $table->dropColumn('type');
            $table->dropColumn('office_no');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
            $table->dropColumn('date_joined');
            $table->dropColumn('active');
        });
    }
}
