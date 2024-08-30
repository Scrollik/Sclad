<?php

namespace App\Services;

use App\Enum\ScladType;
use App\Repositories\DeliveryRepository;
use App\Repositories\MaterialsRepositroy;
use App\Repositories\ScladRepository;
use Spatie\LaravelData\DataCollection;


class DeliveryService
{
    protected DeliveryRepository $deliveryRepository;
    protected MaterialsRepositroy $materialsRepositroy;
    protected ScladRepository $scladRepository;

    public function __construct(
        DeliveryRepository $deliveryRepository,
        MaterialsRepositroy $materialsRepositroy,
        ScladRepository $scladRepository
    ) {
        $this->deliveryRepository = $deliveryRepository;
        $this->materialsRepositroy = $materialsRepositroy;
        $this->scladRepository = $scladRepository;
    }

    public function getMaterials(): ?DataCollection
    {
        return $this->materialsRepositroy->getMaterials();
    }

    public function getDeliveries(): ?DataCollection
    {
        return $this->deliveryRepository->getDeliveries();
    }

    public function getDeliveryForModal(int $id): array
    {
        $deliveryTable = [];
        $delivery = $this->deliveryRepository->getDeliveryForModal($id);
        $deliveryTable['delivery'] = $delivery;
        $deliveryTable['material'] = $delivery->deliveryMaterials->resolve();
        return $deliveryTable;
    }

    public function storeDelivery(array $params)
    {
        $rawMaterials = [];
        $this->deliveryRepository->storeDelivery($params);
        foreach ($params['material'] as $i => $id) {
            if (is_null(
                $this->scladRepository->findMaterialByMaterialId(
                    ScladType::Raw,
                    $params['material'][$i]['material_id']
                )->id
            )) {
                $this->scladRepository->storeRawMaterials(
                    $params['material'][$i]['material_id'],
                    $params['material'][$i]['amount'],
                );
            } else {
                $rawMaterials[$params['material'][$i]['material_id']] = (int)$params['material'][$i]['amount'];
            }
        }
        if ($rawMaterials) {
            $this->scladRepository->increment(ScladType::Raw, $rawMaterials);
        }
    }

}
