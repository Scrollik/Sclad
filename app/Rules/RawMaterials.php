<?php

namespace App\Rules;

use App\Enum\ScladType;
use App\Repositories\ScladRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Arr;

class RawMaterials implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->checkUniqueMaterial($value, $fail);
        $this->checkAmountMaterial($value, $fail);
    }

    private function checkUniqueMaterial(array $value, Closure $fail)
    {
        $duplicates = collect(Arr::get($value, 'material_id', []))->duplicates();
        if (!$duplicates->isEmpty()) {
            $fail("Ошибка! Выбраны одинаковые материалы!");
        }
    }

    private function checkAmountMaterial(array $value, Closure $fail): void
    {
        /** @var ScladRepository $scladRepository */
        $scladRepository = app(ScladRepository::class);
        $amountMaterials = collect(Arr::get($value, 'amount', []));

        if ($amountMaterials->isEmpty()) {
            return;
        }

        foreach ($amountMaterials as $i => $amount) {
            if (empty($amount)) {
                $fail('Поле количество должно быть заполенено');
                return;
            }

            $amountRawMaterial = $scladRepository->getMaterialAmount(ScladType::Raw, (int)$value['material_id'][$i]);


            if ($amountRawMaterial >= $amount) {
                continue;
            }

            $nameMaterial = $scladRepository->findMaterialByMaterialId(ScladType::Raw, $value['material_id'][$i]);
            $errorFormat = 'Максимальное количество материала %s %sx%s : %d ед.';
            $fail(
                sprintf(
                    $errorFormat,
                    $nameMaterial->material->nameMaterials,
                    $nameMaterial->material->height,
                    $nameMaterial->material->width,
                    $amountRawMaterial
                )
            );
        }
    }
}
