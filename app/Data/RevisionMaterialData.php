<?php

namespace App\Data;

use App\Models\RevisionMaterial;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class RevisionMaterialData extends Data
{
    public function __construct(
        public int $revisionId,
        public int $materialId,
        public string $type,
        public ?int $amount,
        public ?int $oldAmount,
        public DataCollection|Lazy|null $materials,
    ) {
    }

    public static function fromModel(RevisionMaterial $revisionMaterial): self
    {
        return new self(
            $revisionMaterial->revision_id,
            $revisionMaterial->material_id,
            $revisionMaterial->type,
            empty($revisionMaterial->amount) ? 0 : $revisionMaterial->amount,
            empty($revisionMaterial->old_amount) ? 0 : $revisionMaterial->old_amount,
            Lazy::create(fn() => MaterialData::from($revisionMaterial->materials)),
        );
    }
}
