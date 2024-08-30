<?php

namespace App\Repositories;

use App\Data\DryingMaterialsData;
use App\Models\DryingMaterial;
use Spatie\LaravelData\DataCollection;

class DryingMaterialsRepository
{
    /**
     *@return DataCollection<DryingMaterial>
     */
    public function getForDashboard(): ?DataCollection
    {
        return
            DryingMaterialsData::collect(
                DryingMaterial::whereRelation('history', 'status', 0)
                    ->with('materials')
                    ->orderBy('material_id')
                    ->get(),
                DataCollection::class
            );
    }

}