<?php

namespace App\Services;

use App\Repositories\UsersRepository;

class AdminService
{
    protected UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function updateUsers(array $validated): void
    {
        if (!$validated['password']) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }
        $this->usersRepository->updateUsers($validated);
    }


}
