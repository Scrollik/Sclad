<?php

namespace App\Http\Controllers;


use App\Http\Resources\ScladResource;
use App\Repositories\DryingHistoryRepository;
use App\Repositories\ScladRepository;
use App\Services\ScladService;


class ScladController extends Controller
{
    public function __construct(
        protected ScladRepository $scladRepository,
        protected DryingHistoryRepository $dryingHistoryRepository,
        ScladService $scladService,
    ) {
        $this->ScladService = $scladService;
    }

    public function allmaterial()
    {
        $raws = ScladResource::collection($this->scladRepository->getRawMaterials()->toCollection());
        $dries = ScladResource::collection($this->scladRepository->getDryMaterials()->toCollection());
        $suhs = $this->ScladService->getDryingForDashboard();
        $orders = $this->ScladService->getOrderForDashboard();
        $totalAmount = $this->ScladService->totalAmount();
        $totalAmountWithDrying = $this->ScladService->totalAmountForDashboard();
        return view('dashboard', compact('raws', 'dries', 'suhs','orders','totalAmount','totalAmountWithDrying'));
    }
}
