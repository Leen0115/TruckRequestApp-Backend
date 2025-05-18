<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('truck_requests', function (Blueprint $table) {
            $table->string('cargo_type')->after('weight'); // Add the cargo_type column
        });
    }
    
    public function down(): void
    {
        Schema::table('truck_requests', function (Blueprint $table) {
            $table->dropColumn('cargo_type'); // Remove the cargo_type column
        });
    }
};