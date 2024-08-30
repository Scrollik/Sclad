<?php

namespace App\Services;

use App\Enum\ScladType;
use App\Repositories\DryingHistoryRepository;
use App\Repositories\DryingMaterialsRepository;
use App\Repositories\OrderMaterialsRepository;
use App\Repositories\ScladRepository;
use Illuminate\Support\Arr;

class ScladService
{
    public function __construct(
        protected ScladRepository $scladRepository,
        protected DryingHistoryRepository $dryingHistoryRepository,
        protected DryingMaterialsRepository $dryingMaterialsRepository,
        protected OrderMaterialsRepository $orderMaterialsRepository,
    ) {
    }

    public function sendingDryers(array $params): void
    {
        $rawMaterials = [];
        foreach ($params['raw_materials']['material_id'] as $i => $id) {
            $rawMaterials[$id] = (int)$params['raw_materials']['amount'][$i];
        }
        $this->dryingHistoryRepository->storeDryingHistory($params, $rawMaterials);
        foreach ($rawMaterials as $i => $material) {
            $rawMaterials[$i] = -1 * $material;
        }
        $this->scladRepository->increment(ScladType::Raw, $rawMaterials);
    }

    public function getDryingForDashboard(): array
    {
        $dryingMaterials = $this->dryingMaterialsRepository->getForDashboard();
        $materials = [];
        foreach ($dryingMaterials as $material) {
            if (array_key_exists($material->materialId, $materials)) {
                $materials[$material->materialId]['amount'] += $material->amount;
            } else {
                $materials[$material->materialId]['amount'] = $material->amount;
                $materials[$material->materialId]['name'] = $material->materials->resolve()->nameMaterials;
                $materials[$material->materialId]['height'] = $material->materials->resolve()->height;
                $materials[$material->materialId]['width'] = $material->materials->resolve()->width;
                $materials[$material->materialId]['materialId'] = $material->materials->resolve()->id;
            }
        }
        return $materials;
    }

    public function getOrderForDashboard(): array
    {
        $orderMaterials = $this->orderMaterialsRepository->getOrderMaterialsForDashboard();
        $materials = [];
        $nameFormat = '%s %s';
        foreach ($orderMaterials as $material) {
            if (array_key_exists($material->scladMaterials->resolve()->id, $materials)) {
                $materials[$material->scladMaterials->resolve()->id]['amount'] += $material->amount;
            } else {
                $materials[$material->scladMaterials->resolve()->id]['amount'] = $material->amount;
                $materials[$material->scladMaterials->resolve()->id]['materialId'] = $material->scladMaterials->resolve()->materialId;
                if ($material->scladMaterials->resolve()->type == ScladType::Dry->value) {
                    $materials[$material->scladMaterials->resolve()->id]['name'] = sprintf(
                        $nameFormat,
                        'Сухой',
                        $material->scladMaterials->material->resolve()->nameMaterials,
                    );
                } else {
                    $materials[$material->scladMaterials->resolve()->id]['name'] = sprintf(
                        $nameFormat,
                        'Сырой',
                        $material->scladMaterials->material->resolve()->nameMaterials,
                    );
                }
            }
            $materials[$material->scladMaterials->resolve(
            )->id]['height'] = $material->scladMaterials->material->resolve()->height;
            $materials[$material->scladMaterials->resolve(
            )->id]['width'] = $material->scladMaterials->material->resolve()->width;
        }
        return $materials;
    }

    public function totalAmount(): array
    {
        $orderMaterials = $this->getOrderForDashboard();
        $dryingMaterials = $this->getDryingForDashboard();
        $totalScladAmount = $this->scladRepository->getTotalAmount();
        $totalAmount = [];
        foreach ($totalScladAmount as $item) {
            $totalAmount[$item->materialId]['amount'] = $item->totalAmount;
            $totalAmount[$item->materialId]['materialId'] = $item->materialId;
            $totalAmount[$item->materialId]['name'] = $item->material->resolve()->nameMaterials;
            $totalAmount[$item->materialId]['height'] = $item->material->resolve()->height;
            $totalAmount[$item->materialId]['width'] = $item->material->resolve()->width;
        }
        foreach ($dryingMaterials as $material) {
            if (array_key_exists($material['materialId'], $totalAmount)) {
                $totalAmount[$material['materialId']]['amount'] += $material['amount'];
            }
        }
        $result = [];
        array_map(function ($item) use (&$result) {
            $result[$item['materialId']] = isset($result[$item['materialId']]) ? $result[$item['materialId']] + $item['amount'] : $item['amount'];
        }, $orderMaterials);
        foreach ($totalAmount as $i => $value) {
            if (array_key_exists($i, $result)) {
                $totalAmount[$i]['amount'] -= $result[$i];
            }
        }
        return $totalAmount;
    }
    public function totalAmountForDashboard(): array
    {
        $dryMaterials = $this->getDryingForDashboard();
        $totalScladAmount = $this->scladRepository->getTotalAmount();
        $totalAmount = [];
        foreach ($totalScladAmount as $item) {
            $totalAmount[$item->materialId]['amount'] = $item->totalAmount;
            $totalAmount[$item->materialId]['materialId'] = $item->materialId;
            $totalAmount[$item->materialId]['name'] = $item->material->resolve()->nameMaterials;
            $totalAmount[$item->materialId]['height'] = $item->material->resolve()->height;
            $totalAmount[$item->materialId]['width'] = $item->material->resolve()->width;
        }
        foreach ($dryMaterials as $material) {
            if (array_key_exists($material['materialId'], $totalAmount)) {
                $totalAmount[$material['materialId']]['amount'] += $material['amount'];
            }
        }

        return $totalAmount;
    }
}
