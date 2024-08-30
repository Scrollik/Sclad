<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDryersRequest;
use App\Http\Requests\StoreMaterialsRequest;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateDryersRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\DryersRepository;
use App\Repositories\MaterialsRepositroy;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Services\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        AdminService $adminService,
        protected UsersRepository $usersRepository,
        protected RolesRepository $rolesRepository,
        protected MaterialsRepositroy $materialsRepositroy,
        protected DryersRepository $dryersRepository,
    ) {
        $this->AdminService = $adminService;
    }

    public function index(): View
    {
        $this->authorize('admin', User::class);
        $users = $this->usersRepository->getUsers();
        $roles = $this->rolesRepository->getRoles();
        $materials = $this->materialsRepositroy->getMaterials();
        $dryers = $this->dryersRepository->getDryers();
        return view('admin.admin_panel', compact('users', 'roles', 'materials', 'dryers'));
    }

    public function edit(int $id): ?UserResource
    {
        $this->authorize('admin', User::class);
        $user = $this->usersRepository->findUser($id);
        return new UserResource($user);
    }

    public function store(StoreUsersRequest $request): void
    {
        $validated = $request->validated();
        $this->usersRepository->createUsers($validated);
    }

    public function update(UpdateUserRequest $request): void
    {
        $validated = $request->validated();
        $this->AdminService->updateUsers($validated);
    }

    public function materialsStore(StoreMaterialsRequest $request): void
    {
        $validated = $request->validated();
        $this->materialsRepositroy->createMaterials($validated);
    }

    public function materialsEdit($id): ?JsonResponse
    {
        $this->authorize('admin', User::class);
        $material = $this->materialsRepositroy->findMaterial($id);
        return response()->json($material);
    }

    public function materialsUpdate(UpdateMaterialRequest $request): void
    {
        $validated = $request->validated();
        $this->materialsRepositroy->updateMaterials($validated);
    }

    public function materialsDelete($id): RedirectResponse
    {
        $this->authorize('admin', User::class);
        $this->materialsRepositroy->deleteMaterial($id);
        return redirect()->route('admin_panel.index');
    }

    public function dryersEdit($id): JsonResponse
    {
        $this->authorize('admin', User::class);
        $dryers = $this->dryersRepository->findDryer($id);
        return response()->json($dryers);
    }

    public function dryersStore(StoreDryersRequest $request): void
    {
        $validated = $request->validated();
        $this->dryersRepository->createDryers($validated);
    }

    public function dryersUpdate(UpdateDryersRequest $request): void
    {
        $validated = $request->validated();
        $this->dryersRepository->updateDryers($validated);
    }

    public function dryersDelete($id): RedirectResponse
    {
        $this->authorize('admin', User::class);
        $this->dryersRepository->deleteDryers($id);
        return redirect()->route('admin_panel.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->authorize('admin', User::class);
        $this->usersRepository->deleteUser($id);
        return redirect()->route('admin_panel.index');
    }
}
