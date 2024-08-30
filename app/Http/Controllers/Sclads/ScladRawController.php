<?php

namespace App\Http\Controllers\Sclads;

use App\Enum\ScladType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewDryerRequest;
use App\Http\Requests\TestRequest;
use App\Http\Requests\UpdateScladRequest;
use App\Http\Resources\ScladResource;
use App\Models\User;
use App\Repositories\ScladRepository;
use App\Services\ScladService;
use App\Repositories\DryersRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class ScladRawController extends Controller
{
    public function __construct(ScladService $scladService, protected ScladRepository $scladRepository)
    {
        $this->ScladService = $scladService;
    }

    public function index(DryersRepository $dryersRepository): View
    {
        $raws = $this->scladRepository->getRawMaterials();
        $dryers = $dryersRepository->getDryers();
        return view('sclad_raw.raws', compact('raws', 'dryers'));
    }

    public function find(int $id): JsonResponse
    {
        $this->authorize('update', User::class);
        $amount = $this->scladRepository->findMaterialByMaterialId(ScladType::Raw, $id);
        return response()->json($amount);
    }

    public function getRawMaterialsForModal()
    {
        $rawMaterials = $this->scladRepository->getRawMaterials();
        return ScladResource::collection($rawMaterials->toCollection());
    }


    public function update(UpdateScladRequest $request): void
    {
        $validated = $request->validated();
        $this->scladRepository->update($validated, ScladType::Raw);
    }

    public function store(StoreNewDryerRequest $request): void
    {
        $params = $request->validated();
        $this->ScladService->sendingDryers($params);
    }

}
