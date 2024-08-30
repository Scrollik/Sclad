<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $email,
        public string $name,
        public int $role,
    ) {
    }
}
