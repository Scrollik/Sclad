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
        Schema::create('delivery_materials', function (Blueprint $table) {
            $table->integer('delivery_id');
            $table->foreign('delivery_id', 'delivery_id_fk')->on('deliveries')->references('id_delivery')->onDelete('cascade');
            $table->integer('materials_id');
            $table->foreign('materials_id', 'materials_id_fk')->on('materials')->references('id');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_materials');
    }
};
