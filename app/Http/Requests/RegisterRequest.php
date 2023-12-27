<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determines if the user is authorized to perform the action.
     *
     * @return bool Whether the user is authorized or not.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retrieves the validation rules for the input fields.
     *
     * @return array The array containing the validation rules.
     */
    public function rules(): array
    {
        return [
                'name' => 'required|unique:users|string|max:50',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8',
        ];
    }
}
