<?php

namespace App\Services;


use App\Enum\ScladType;
use App\Repositories\DryingHistoryRepository;
use App\Repositories\ScladRepository;

class DryingHistoryService
{
    protected DryingHistoryRepository $dryingHistoryRepository;
    protected ScladRepository $scladRepository;

    public function __construct(DryingHistoryRepository $dryingHistoryRepository, ScladRepository $scladRepository)
    {
        $this->DryingHistoryRepository = $dryingHistoryRepository;
        $this->ScladRepository = $scladRepository;
    }

    public function updateMaterialsAfterDrying(int $id): void
    {
        $materials = $this->DryingHistoryRepository->getDryingHistoryWithMaterial($id);
        foreach ($materials as $material) {
            foreach ($material->dryingMaterials->resolve() as $dryingMaterial) {
                if (!is_null(
                    $this->ScladRepository->findMaterialByMaterialId(ScladType::Dry, $dryingMaterial->id)->id
                )) {
                    $amount = $this->ScladRepository->getMaterialAmount(ScladType::Dry, $dryingMaterial->id);
                    $amount += $dryingMaterial->amount;
                    $this->ScladRepository->updateAfterDrying(ScladType::Dry, $dryingMaterial->id, $amount);
                } else {
                    $this->ScladRepository->storeDryMaterials($dryingMaterial->id, $dryingMaterial->amount);
                }
            }
        }
    }

}
