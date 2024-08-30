<?php

namespace App\Repositories;

use App\Data\RoleData;
use App\Models\Role;
use Spatie\LaravelData\DataCollection;

class RolesRepository
{
    public function getRoles(): ?DataCollection
    {
        return RoleData::collect(Role::all(), DataCollection::class);
    }

}
