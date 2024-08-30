<?php

namespace App\Repositories;

use App\Data\DeliveryData;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\DataCollection;

class DeliveryRepository
{
    public function getDeliveries(): ?DataCollection
    {
        return DeliveryData::collect(
            Delivery::orderBy('date', 'DESC')->get(),
            DataCollection::class
        );
    }

    public function storeDelivery(array $params): void
    {
        $delivery = Delivery::create([
            'supplier' => $params['supplier'],
            'date' => $params['date'],
        ]);

        foreach ($params['material'] as $materials) {
            $delivery->material()->attach($materials['material_id'], ['amount' => $materials['amount']]);
        }
    }

    public function getDeliveryForModal(int $id): ?DeliveryData
    {
        return DeliveryData::from(
            Delivery::where('id', $id)
                ->with('material')
                ->first()
        );
    }

    public function deleteDelivery(int $id): void
    {
        Delivery::destroy($id);
    }

    public function deleteAllDelivery(): void
    {
        Delivery::whereNotNull('id')->delete();
    }

}
