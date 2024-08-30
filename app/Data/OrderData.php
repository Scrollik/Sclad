<?php

namespace App\Data;

use App\Models\Order;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class OrderData extends Data
{
    public function __construct(
        public ?int $id,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'd.m.Y')]
        public Carbon $date,
        public bool $status,
        public string $customer,
        public DataCollection|Lazy|null $orderMaterials,
    ) {
    }

    public static function fromModel(Order $order): self
    {
        return new self(
            $order->id,
            $order->date,
            $order->status,
            $order->customer,
            Lazy::create(fn() => ScladData::collect($order->orderMaterials)),
        );
    }

}