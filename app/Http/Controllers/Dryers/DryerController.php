<?php

namespace App\Http\Controllers\Dryers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\DryersRepository;
use App\Repositories\DryingHistoryRepository;
use App\Services\DryingHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class DryerController extends Controller
{

    public function __construct(
        protected DryersRepository $dryersRepository,
        protected DryingHistoryRepository $dryingHistoryRepository,
        DryingHistoryService $DryingHistoryService
    ) {
        $this->DryingHistoryService = $DryingHistoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('role', User::class);
        $dryers = $this->dryersRepository->getDryers();
        $dryersTable = $this->dryingHistoryRepository->getDryingHistoryWithDryer();
        return view('dryers.dryers', compact('dryers', 'dryersTable'));
    }

    public function edit(string $id): JsonResponse
    {
        $this->authorize('role', User::class);
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $this->authorize('role', User::class);
        $id = $request->id;
        $this->DryingHistoryService->updateMaterialsAfterDrying($id);
        $this->dryingHistoryRepository->updateStatus($id);
        return redirect('sclad_dryers/dryer');
    }

}
