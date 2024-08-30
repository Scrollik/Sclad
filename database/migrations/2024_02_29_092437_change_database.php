<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sclads', function (Blueprint $table) {
            $table->id();
            $table->integer('material_id');
            $table->foreign('material_id', 'material_id_fk')->on('materials')->references('id')->onDelete('cascade');
            $table->enum('type', ['dry', 'raw']);
            $table->integer('amount');
            $table->timestamps();
        });
        // Копирование старых данных
        DB::insert(
            'INSERT INTO sclads (material_id, amount, type)
        SELECT materials_id, amount, "raw"
        FROM sclad_of_raws'
        );

        DB::insert(
            'INSERT INTO sclads (material_id, amount, type)
        SELECT materials_id, amount, "dry"
        FROM sclad_of_dries'
        );

        Schema::table('drying_materials', function (Blueprint $table) {
            $table->dropForeign('raw_materials_id_fk');
            $table->dropForeign('history_id_fk');
            $table->renameColumn('raw_materials_id', 'material_id');
            $table->foreign('material_id', 'drying_materials_material_id_fk')->on('sclads')->references(
                'material_id'
            )->onDelete('cascade');
            $table->renameColumn('history_id', 'drying_history_id');
            $table->foreign('drying_history_id', 'drying_history_id_fk')->on('drying_histories')->references(
                'id'
            )->onDelete('cascade');
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->renameColumn('id_delivery', 'id');
        });

        Schema::table('delivery_materials', function (Blueprint $table) {
            $table->dropForeign('materials_id_fk');
            $table->dropForeign('delivery_id_fk');
        });

        Schema::table('delivery_materials', function (Blueprint $table) {
            $table->renameColumn('materials_id', 'material_id');
            $table->foreign('material_id', 'delivery_materials_material_id_fk')->on('materials')->references(
                'id'
            )->onDelete('cascade');
        });

        Schema::table('drying_histories', function (Blueprint $table) {
            $table->dropColumn('id_dryers');
            $table->integer('dryer_id');
            $table->foreign('dryer_id', 'dryer_id_fk')->on('dryers')->references('id')->onDelete('cascade');
        });

        Schema::dropIfExists('sclad_of_raws');
        Schema::dropIfExists('sclad_of_dries');

        Schema::table('order_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk')->on('orders')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('sclad_id');
            $table->foreign('sclad_id', 'sclad_id_fk')->on('sclads')->references('id')->onDelete('cascade');
            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('sclad_of_raws', function (Blueprint $table) {
            $table->integer('materials_id', 'id_raws_materials_idx');
            $table->foreign('materials_id', 'id_raws_materials_fk')->on('materials')->references('id')->onDelete(
                'cascade'
            );
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('sclad_of_dries', function (Blueprint $table) {
            $table->integer('materials_id', 'id_dries_materials_idx');
            $table->foreign('materials_id', 'id_dries_materials_fk')->on('materials')->references('id')->onDelete(
                'cascade'
            );
            $table->integer('amount');
            $table->timestamps();
        });


        DB::insert(
            'INSERT INTO sclad_of_raws (materials_id, amount)
        SELECT material_id, amount
        WHERE type = "raw"
        FROM sclads'
        );

        DB::insert(
            'INSERT INTO sclad_of_dries (materials_id, amount)
        SELECT material_id, amount
        WHERE type = "dry"
        FROM sclads'
        );

        Schema::dropIfExists('sclads');

        Schema::table('drying_materials', function (Blueprint $table) {
            $table->dropForeign('drying_materials_material_id_fk');
            $table->dropForeign('drying_history_id_fk');
            $table->renameColumn('material_id', 'raw_materials_id');
            $table->foreign('raw_materials_id', 'raw_materials_id_fk')->on('sclad_of_raws')->references(
                'materials_id'
            )->onDelete('cascade');
            $table->renameColumn('drying_history_id', 'history_id');
            $table->foreign('history_id', 'history_id_fk')->on('drying_histories')->references('id')->onDelete(
                'cascade'
            );
        });

        Schema::table('delivery_materials', function (Blueprint $table) {
            $table->dropForeign('delivery_materials_material_id_fk');
            $table->renameColumn('material_id', 'materials_id');
            $table->foreign('materials_id', 'materials_id_fk')->on('materials')->references('id');
        });

        Schema::table('drying_histories', function (Blueprint $table) {
            $table->renameColumn('dryer_id', 'id_dryers');
            $table->dropForeign('dryer_id_fk');
        });
    }
};
