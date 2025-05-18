<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('truck_requests', function (Blueprint $table) {
        $table->string('status')->default('Pending');
    });
}

public function down()
{
    Schema::table('truck_requests', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}


};