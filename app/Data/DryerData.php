<?php

namespace App\Data;

use App\Models\Dryer;
use Spatie\LaravelData\Data;

class DryerData extends Data
{
    public function __construct(
        public int $id,
        public string $dryersName,
    ) {
    }

    public static function fromModel(Dryer $dryer): self
    {
        return new self(
            $dryer->id,
            $dryer->dryers_name,
        );
    }


}
