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
        Schema::create('revision_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('revision_id');
            $table->foreign('revision_id', 'revision_id_fk')->on('revisions')->references('id')->onDelete('cascade');
            $table->integer('material_id');
            $table->foreign('material_id', 'revisions_material_id_fk')->on('materials')->references('id')->onDelete('cascade');
            $table->enum('type',['dry','raw']);
            $table->integer('amount');
            $table->integer('old_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions_materials');
    }
};
