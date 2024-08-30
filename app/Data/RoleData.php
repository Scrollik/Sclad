<?php

namespace App\Data;

use App\Models\Role;
use Spatie\LaravelData\Data;

class RoleData extends Data
{
    public function __construct(
        public int $id,
        public string $nameRole,
    ) {
    }

    public static function fromModel(Role $role): self
    {
        return new self(
            $role->id,
            $role->name_role,
        );
    }

}
