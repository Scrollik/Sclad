<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class OrderMaterials implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->checkUniqueMaterial($value, $fail);
    }

    private function checkUniqueMaterial(array $value, Closure $fail)
    {
        $duplicates = collect(Arr::get($value, 'material_id', []))->duplicates();
        if (!$duplicates->isEmpty()) {
            $fail("Ошибка! Выбраны одинаковые материалы!");
        }
    }
}
