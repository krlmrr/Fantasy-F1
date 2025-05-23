<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
            $table->string('track_name')->after('name')->nullable();
            $table->string('country')->after('track_name')->nullable();
            $table->string('date_time')->after('country')->nullable();
            $table->integer('franchise_id')->after('date_time')->nullable();
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('track_name');
            $table->dropColumn('country');
            $table->dropColumn('date_time');
            $table->dropColumn('franchise_id');
        });
    }
};
