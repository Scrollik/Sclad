<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\Delivery;
use App\Models\User;
use App\Repositories\DeliveryRepository;
use App\Services\DeliveryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    public function __construct(
        DeliveryService $deliveryService,
        protected DeliveryRepository $deliveryRepository,
    ) {
        $this->DeliveryService = $deliveryService;
    }

    public function index(): View
    {
        $this->authorize('role', User::class);
        $materials = $this->DeliveryService->getMaterials();
        $delivery = $this->DeliveryService->getDeliveries();
        return view('delivery.delivery', compact('delivery', 'materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        $this->authorize('role', User::class);
        $material = $this->DeliveryService->getMaterials();
        return response()->json($material);
    }

    /**
     * Store a newly created resource in storage.
     */
//    Сохранение поставки
    public function store(StoreDeliveryRequest $request): void
    {
        $params = $request->validated();
        $this->DeliveryService->storeDelivery($params);
    }

    /**
     * Display the specified resource.
     */
//    Передача данных в модальное окно с таблицей состава поставки
    public function show(int $id): JsonResponse
    {
        $this->authorize('role', User::class);
        $deliveryTable = $this->DeliveryService->getDeliveryForModal($id);
        return response()->json($deliveryTable);
    }

    public function destroyAllDelivery(): RedirectResponse
    {
        $this->authorize('role',User::class);
        $this->deliveryRepository->deleteAllDelivery();
        return redirect()->route('supplies.index');
    }

//    Удаление поставки из истории поставок
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('role', User::class);
        $this->deliveryRepository->deleteDelivery($id);
        return redirect()->route('supplies.index');
    }

}
