<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('admin', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'unique:users'],
            'name_sotr' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role_rab' => ['sometimes', 'required'],
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
            'email.unique:users' => 'Данный электронный адрес уже используется.',
            '*.required' => 'Поле не может быть пустым.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }


}
