<?php

namespace App\Data;

use App\Models\OrderMaterial;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class OrderMaterialData extends Data
{
    public function __construct(
        public ?int $orderId,
        public ?int $scladId,
        public ?int $amount,
        public DataCollection|Lazy|null $scladMaterials,
    ) {
    }

    public static function fromModel(OrderMaterial $orderMaterial): self
    {
        return new self(
            empty($orderMaterial->order_id) ? null : $orderMaterial->order_id,
            empty($orderMaterial->sclad_id) ? null : $orderMaterial->sclad_id,
            empty($orderMaterial->amount) ? null : $orderMaterial->amount,
            Lazy::create(fn() => ScladData::from($orderMaterial->scladMaterials)),
        );
    }

}