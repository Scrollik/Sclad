<?php

namespace App\Data;

use App\Models\Material;
use App\Models\Sclad;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Resource;

class ScladData extends Resource
{
    public function __construct(
        public ?int $id,
        public ?int $materialId,
        public ?int $amount,
        public ?string $type,
        public ?int $totalAmount,
        public MaterialData|Lazy|null $material,
    ) {
    }

    public static function fromModel(Sclad $sclad): self
    {
        return new self(
           empty($sclad->id) ? null : $sclad->id,
            empty($sclad->material_id) ? null : $sclad->material_id,
            empty($sclad->amount) ? null : $sclad->amount,
            empty($sclad->type) ? null : $sclad->type,
            empty($sclad->totalAmount) ? null : $sclad->totalAmount,
            Lazy::create(fn() => MaterialData::from($sclad->material)),
        );
    }
}
