<?php

namespace App\Repositories;

use App\Data\DryingHistoryData;
use App\Models\DryingHistory;
use App\Models\DryingMaterial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Spatie\LaravelData\DataCollection;

class DryingHistoryRepository
{
    public function storeDryingHistory(array $params, array $rawMaterials): void
    {
        $drying = dryingHistory::create([
            'date' => $params['date'],
            'dryer_id' => $params['id_dryers'],
        ]);
        foreach ($rawMaterials as $i => $rawMaterial) {
            $drying->dryingMaterials()->attach($i, ['amount' => $rawMaterial]);
        }
    }

    public function getDryingHistoryWithDryer(): DataCollection
    {
        $dryingHistory = DryingHistoryData::collect(
            DryingHistory::with('dryingMaterials')
                ->where('status', '=', 0)
                ->get()
            ,
            DataCollection::class
        );
        return $dryingHistory;
    }

    public function getDryingHistoryForModal(): DataCollection
    {
        $dryingHistory = DryingHistoryData::collect(
            DryingHistory::with('dryingMaterials')
                ->where('status', '=', 1)
                ->get()
            ,
            DataCollection::class
        );
        return $dryingHistory;
    }

    public function getDryingHistoryWithMaterial(int $id)
    {
        $dryingHistory = DryingHistoryData::collect(
            DryingHistory::where('dryer_id', $id)
                ->where('status', 0)
                ->with('dryingMaterials')
                ->get()
        );
        return $dryingHistory;
    }

    public function updateStatus(int $id): void
    {
        dryingHistory::where('dryer_id', $id)->update(['status' => 1]);
    }

}
