<?php

namespace App\Repositories;

use App\Data\OrderData;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class OrderRepository
{
    public function getOrders(): ?DataCollection
    {
        $orders = OrderData::collect(
            Order::orderBy('date', 'ASC')
                ->where('status', 0)
                ->get(),
            DataCollection::class
        );
        return $orders;
    }

    public function getOrderHistory()
    {
        return OrderData::collect(
            Order::where('status', 1)
                ->get(),
            DataCollection::class
        );
    }

    public function storeNewOrder(array $params, array $materials): JsonResponse
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'date' => $params['date'],
                'customer' => $params['owner'],
            ]);

            foreach ($materials as $i => $material) {
                $order->orderMaterials()->attach($i, ['amount' => $material]);
            }

            DB::commit();

            return response()->json(['message' => 'Заказ создан!']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Ошибка, заказ не создан!'], 500);
        }
    }

    public function updateOrderStatus(int $id): void
    {
        Order::where('id', $id)
            ->update([
                'status' => 1,
            ]);
    }

    public function deleteOrder(int $id): void
    {
        Order::destroy($id);
    }

}
