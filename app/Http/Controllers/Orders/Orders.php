<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderMaterialsResource;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderMaterialsRepository;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use Spatie\LaravelData\DataCollection;

class Orders extends Controller
{

    public function __construct(
        protected OrderService $orderService,
        protected OrderRepository $orderRepository,
        protected OrderMaterialsRepository $orderMaterialsRepository,
    ) {
    }

    public function index(): View
    {
        $orders = $this->orderRepository->getOrders();
        return view('orders.order', compact('orders'));
    }

    public function getMaterialsForModal(): array
    {
        $materials = $this->orderService->getMaterialsForModal();
        return $materials;
    }

    public function confirmOrder(int $id): RedirectResponse
    {
        $this->authorize('role', User::class);
        $this->orderService->confirmOrder($id);
        return redirect()->route('orders.index');
    }

    public function getOrderHistory(): DataCollection
    {
        return $this->orderRepository->getOrderHistory();
    }

    public function store(StoreNewOrderRequest $request)
    {
        $this->authorize('role', User::class);
        $params = $request->validated();
        return $this->orderService->storeNewOrder($params);
    }

    public function updateOrder(UpdateOrderRequest $request): void
    {
        $this->orderService->updateOrder($request->validated());
    }

    public function show(string $id): AnonymousResourceCollection
    {
        $orders = $this->orderMaterialsRepository->getOrderMaterial($id);
        return OrderMaterialsResource::collection($orders->toCollection());
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->authorize('role', User::class);
        $this->orderRepository->deleteOrder($id);
        return redirect()->route('orders.index');
    }
}
