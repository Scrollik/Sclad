<?php

namespace App\Repositories;

use App\Data\OrderMaterialData;
use App\Models\OrderMaterial;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class OrderMaterialsRepository
{
    public function getOrderMaterial(int $id): ?DataCollection
    {
        return OrderMaterialData::collect(
            OrderMaterial::with('scladMaterials')
                ->where('order_id', $id)
                ->get(),
            DataCollection::class
        );
    }

    public function getOrderMaterialsForDashboard(): ?DataCollection
    {
        return OrderMaterialData::collect(
            OrderMaterial::whereRelation('orders','status',0)
            ->with('scladMaterials')
                ->orderBy('sclad_id')
                ->get(),
            DataCollection::class
        );
    }

    public function getOrderMaterialSum(): ?DataCollection
    {
        return OrderMaterialData::collect(
            OrderMaterial::select('material_id', DB::raw('SUM(amount) as totalAmount'))
                ->whereRelation('orders','status',0)
                ->with('scladMaterials')
                ->orderBy('sclad_id')
                ->get(),
            DataCollection::class
        );
    }
}