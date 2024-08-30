<?php

namespace App\Http\Controllers\Sclads;

use App\Enum\ScladType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateScladRequest;
use App\Models\User;
use App\Repositories\DryingHistoryRepository;
use App\Repositories\ScladRepository;
use App\Services\DryerService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ScladDriesController extends Controller
{

    public function __construct(
        protected ScladRepository $scladRepository,
        protected DryingHistoryRepository $dryingHistoryRepository,
    ) {
    }

    public function index(): View
    {
        $dries = $this->scladRepository->getDryMaterials();
        return view('sclad_drie.dries')->with(['dries' => $dries]);
    }

    public function update(UpdateScladRequest $request): void
    {
        $params = $request->validated();
        $this->scladRepository->update($params, ScladType::Dry);
    }

    public function findMaterialAmount(int $id): JsonResponse
    {
        $this->authorize('role', User::class);
        return response()->json($this->scladRepository->findMaterialById($id));
    }


//    Нужно доделать
    public function getDryingHistory(): JsonResponse
    {
        $this->authorize('role', User::class);
        return response()->json($this->dryingHistoryRepository->getDryingHistoryForModal());
    }
}
