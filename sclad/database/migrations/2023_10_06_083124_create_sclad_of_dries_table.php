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
        Schema::create('sclad_of_dries', function (Blueprint $table) {
            $table->integer('materials_id', 'id_dries_materials_idx');
            $table->foreign('materials_id', 'id_dries_materials_fk')->on('materials')->references('id')->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sclad_of_dries');
    }
};
