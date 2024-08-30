<?php

namespace App\Repositories;

use App\Data\RevisionMaterialData;
use App\Models\RevisionMaterial;
use Spatie\LaravelData\DataCollection;

class RevisionMaterialsRepository
{
    public function getMaterialsForModal(int $id)
    {
        return RevisionMaterialData::collect(
            RevisionMaterial::with('materials')
                ->with('revisions')
                ->where('revision_id', $id)
                ->get(),
            DataCollection::class
        );
    }

}
