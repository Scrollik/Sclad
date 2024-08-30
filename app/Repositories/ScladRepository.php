<?php

namespace App\Repositories;

use App\Data\ScladData;
use App\Enum\ScladType;
use App\Models\Sclad;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class ScladRepository
{
    public function getTotalAmount(): ?DataCollection
    {
        return ScladData::collect(
            Sclad::select('material_id', DB::raw('SUM(amount) as totalAmount'))
                ->with('material')
                ->groupBy('material_id')
                ->get(),
            DataCollection::class
        );
    }

    public function storeRawMaterials(int $id, int $amount)
    {
        Sclad::create([
            'material_id' => $id,
            'type' => 'raw',
            'amount' => $amount,
        ]);
    }

    public function storeDryMaterials(int $id, int $amount): void
    {
        Sclad::create([
            'material_id' => $id,
            'type' => 'dry',
            'amount' => $amount,
        ]);
    }

    public function getRawMaterials(): DataCollection
    {
        return ScladData::collect(
            Sclad::with('material')
                ->whereHas('material')
                ->where('type', 'raw')
                ->orderBy('material_id', 'ASC')
                ->get(),
            DataCollection::class
        );
    }


    public function getDryMaterials(): ?DataCollection
    {
        return ScladData::collect(
            Sclad::with('material')
                ->where('type', '=', 'dry')
                ->orderBy('material_id', 'ASC')
                ->get()
            ,
            DataCollection::class
        );
    }

    public function findMaterialByMaterialId(ScladType $sclad, int $id): ?ScladData
    {
        return ScladData::from(
            Sclad::with('material')
                ->where('type', '=', $sclad)
                ->where('material_id', '=', $id)
                ->first()
        );
    }

    public function increment(ScladType $sclad, array $materials): void
    {
        foreach ($materials as $i => $material) {
            $oldAmount = $this->getMaterialAmount($sclad, $i);
            Sclad::where('type', $sclad)
                ->where('material_id', $i)
                ->update([
                    'amount' => $material + $oldAmount,
                ]);
        }
    }

    public function update(array $validated, ScladType $sclad): void
    {
        Sclad::where('id', $validated['id'])
            ->where('type', $sclad)
            ->update([
                'amount' => $validated['amount_material'],
            ]);
    }

    public function getMaterialAmount(ScladType $sclad, int $id): ?int
    {
        return Sclad::where('material_id', $id)
            ->where('type', $sclad)
            ->value('amount');
    }

    public function findMaterialById(int $id): ?ScladData
    {
        return ScladData::from(Sclad::find($id));
    }

    public function findMaterialForOrder(int $id): ?ScladData
    {
        return ScladData::from(
            Sclad::with('material')
                ->find($id)
        );
    }

    public function updateAfterDrying(ScladType $sclad, int $id, int $amount): void
    {
        Sclad::where('material_id', $id)
            ->where('type', $sclad)
            ->update(['amount' => $amount]);
    }

    public function updateAfterOrder(array $orderMaterials)
    {
        foreach ($orderMaterials as $i => $material) {
            $oldAmount = $this->findMaterialById($i)->amount;
            Sclad::where('id', $i)
                ->update([
                    'amount' => $oldAmount + $material,
                ]);
        }
    }
}
