<?php

namespace App\Repositories;

use App\Data\MaterialData;
use App\Models\DryingHistory;
use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\DataCollection;

class MaterialsRepositroy
{
    public function getMaterials(): ?DataCollection
    {
        return MaterialData::collect(Material::all(), DataCollection::class);
    }

    public function findMaterial($id): ?MaterialData
    {
        return MaterialData::from(Material::find($id));
    }

    public function createMaterials(array $validated): void
    {
        Material::create($validated);
    }

    public function updateMaterials(array $validated): void
    {
        Material::where('id', $validated['id'])->update($validated);
    }

    public function deleteMaterial($id): void
    {
        Material::destroy($id);
    }


}
