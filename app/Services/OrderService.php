<?php

namespace App\Services;

use App\Http\Resources\ScladResource;
use App\Models\Order;
use App\Repositories\OrderMaterialsRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ScladRepository;


class OrderService
{
    public function __construct(
        protected ScladRepository $scladRepository,
        protected OrderRepository $orderRepository,
        protected OrderMaterialsRepository $orderMaterialsRepository,
    ) {
    }

    public function getMaterialsForModal(): array
    {
        $materials = [];
        $rawMaterials = ScladResource::collection($this->scladRepository->getRawMaterials()->toCollection());
        $dryMaterials = ScladResource::collection($this->scladRepository->getDryMaterials()->toCollection());
        foreach ($rawMaterials as $i => $rawMaterial) {
            $materials['rawMaterials'][$i] = $rawMaterial;
        }
        foreach ($dryMaterials as $i => $dryMaterial) {
            $materials['dryMaterials'][$i] = $dryMaterial;
        }
        return $materials;
    }

    public function storeNewOrder(array $params)
    {
        $materials = [];
        foreach ($params['materials']['material_id'] as $i => $id) {
            $materials[$id] = (int)$params['materials']['amount'][$i];
        }
        return $this->orderRepository->storeNewOrder($params, $materials);
    }

    public function confirmOrder(int $id): void
    {
        $orderMaterials = [];
        $this->orderRepository->updateOrderStatus($id);
        foreach ($this->orderMaterialsRepository->getOrderMaterial($id) as $material) {
            $orderMaterials[$material->scladId] = -1 * $material->amount;
        }
        $this->scladRepository->updateAfterOrder($orderMaterials);
    }

    public function updateOrder(array $params): void
    {
        $order = Order::find($params['id']);

        $order->customer = $params['owner'];
        $order->date = $params['date'];

        $order->save();

        $data = [];
        foreach ($params['materials']['material_id'] as $i => $material) {
            $data[$material] = ['amount' => $params['materials']['amount'][$i]];
        }
        $order->orderMaterials()->sync($data);
    }

}