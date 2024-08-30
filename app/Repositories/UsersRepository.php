<?php

namespace App\Repositories;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\DataCollection;

class UsersRepository
{
    public function getUsers(): ?DataCollection
    {
        return UserData::collect(User::all(), DataCollection::class);
    }

    public function findUser($id): UserData
    {
        return UserData::from(User::find($id));
    }

    public function createUsers($validated): void
    {
        User::create([
            'name' => $validated['name_sotr'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role_rab'],
        ]);
    }

    public function updateUsers(array $validated): void
    {
        User::where('id', $validated['id'])
            ->update($validated);
    }

    public function deleteUser($id): void
    {
        User::destroy($id);
    }

}
