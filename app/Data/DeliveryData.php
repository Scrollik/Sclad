<?php

namespace App\Data;

use App\Models\Delivery;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class DeliveryData extends Data
{
    public function __construct(
        public ?int $id,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'd.m.Y')]
        public Carbon $date,
        public ?string $supplier,
        public DataCollection|Lazy|null $deliveryMaterials,
    ) {
    }

    public static function fromModel(Delivery $delivery): self
    {
        return new self(
            $delivery->id,
            $delivery->date,
            $delivery->supplier,
            Lazy::create(fn() => MaterialData::collect($delivery->material)),
        );
    }

}
