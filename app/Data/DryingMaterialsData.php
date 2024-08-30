<?php

namespace App\Data;

use App\Models\DryingHistory;
use App\Models\DryingMaterial;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class DryingMaterialsData extends Data
{
    public function __construct(
        public int $dryingHistoryId,
        public int $materialId,
        public int $amount,
        public DataCollection|Lazy|null $materials,
    ) {
    }

    public static function fromModel(DryingMaterial $dryingMaterial): self
    {
        return new self(
            $dryingMaterial->drying_history_id,
            $dryingMaterial->material_id,
            $dryingMaterial->amount,
            Lazy::create(fn() => MaterialData::from($dryingMaterial->materials)),
        );
    }


}
