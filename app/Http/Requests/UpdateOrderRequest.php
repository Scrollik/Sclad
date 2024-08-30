<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\OrderMaterials;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('role', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'date' => ['required'],
            'owner' => ['required'],
            'materials' => ['required', 'array', new OrderMaterials()],
        ];
    }

    public function messages(): array
    {
        return [
            'materials.required' => 'Материалы не могут отсутствовать при редактировании заказа.',
            '*.required' => 'Поле не может быть пустым.',
        ];
    }
}
