<?php

namespace App\Data;

use App\Models\Material;
use Spatie\LaravelData\Data;

use function PHPUnit\Framework\isEmpty;

class MaterialData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $nameMaterials,
        public ?int $height,
        public ?int $width,
        public ?int $amount,
        public ?int $oldAmount,
        public ?string $type,
        public ?int $sum,
    ) {
    }

    public static function fromModel(Material $material): self
    {
        return new self(
            $material->id,
            $material->name_materials,
            $material->height,
            $material->width,
            empty($material->pivot->amount) ? null : $material->pivot->amount,
            empty($material->pivot->old_amount) ? null : $material->pivot->old_amount,
            empty($material->pivot->type) ? null : $material->pivot->type,
            empty($material->pivot->sum) ? null : $material->pivot->sum,
        );
    }

}
