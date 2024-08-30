<?php

namespace App\Data;


use App\Models\DryingHistory;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class DryingHistoryData extends Data
{
    public function __construct(
        public int $id,
        public string $date,
        public int $dryerId,
        public DataCollection|Lazy|null $dryingMaterials,
    ) {
    }

    public static function fromModel(DryingHistory $dryingHistory): self
    {
        return new self(
            $dryingHistory->id,
            $dryingHistory->date,
            $dryingHistory->dryer_id,
            Lazy::create(fn() => MaterialData::collect($dryingHistory->dryingMaterials)),
        );
    }

}
