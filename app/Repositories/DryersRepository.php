<?php

namespace App\Repositories;

use App\Data\DryerData;
use App\Models\Dryer;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\DataCollection;

class DryersRepository
{
    public function getDryers(): ?DataCollection
    {
        return DryerData::collect(Dryer::all(), DataCollection::class);
    }

    public function findDryer($id): DryerData
    {
        return DryerData::from(Dryer::find($id));
    }

    public function createDryers(array $validated): void
    {
        Dryer::create($validated);
    }

    public function updateDryers(array $validated): void
    {
        Dryer::where('id', $validated['id'])->update($validated);
    }

    public function deleteDryers($id): void
    {
        Dryer::destroy($id);
    }
}
