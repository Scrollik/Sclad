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
        Schema::create('drying_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('history_id');
            $table->foreign('history_id', 'history_id_fk')->on('drying_histories')->references('id')->onDelete('cascade');
            $table->integer('raw_materials_id');
            $table->foreign('raw_materials_id', 'raw_materials_id_fk')->on('sclad_of_raws')->references('materials_id')->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dryingMaterials');
    }
};
