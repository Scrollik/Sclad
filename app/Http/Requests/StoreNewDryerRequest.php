<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\RawMaterials;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewDryerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function rules(): array
    {
        return [
            'date' => ['required'],
            'id_dryers' => ['required'],
            'raw_materials' => ['required', 'array', new RawMaterials()],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.required' => 'Поле не может быть пустым.',
        ];
    }
}
