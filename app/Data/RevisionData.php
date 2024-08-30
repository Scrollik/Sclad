<?php

namespace App\Data;

use App\Models\Revision;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class RevisionData extends Data
{
    public function __construct(
        public ?int $id,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'd.m.Y')]
        public Carbon $date,
        public DataCollection|Lazy|null $revisionMaterials,
    ) {
    }

    public static function fromModel(Revision $revision): self
    {
        return new self(
            $revision->id,
            $revision->date,
            Lazy::create(fn() => MaterialData::collect($revision->revisionMaterials)),
        );
    }
}
