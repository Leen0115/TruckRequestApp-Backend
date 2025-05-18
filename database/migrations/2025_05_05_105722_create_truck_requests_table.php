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
    {Schema::create('truck_requests', function (Blueprint $table) {
        $table->id();
        $table->string('pickup_location');
        $table->string('dropoff_location');
        $table->string('pickup_time');
        $table->string('delivery_time');
        $table->string('truck_type');
        $table->integer('weight');
        $table->text('note')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_requests');
    }
};