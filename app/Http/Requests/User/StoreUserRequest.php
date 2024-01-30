<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => ['required', 'string', Password::default(), 'confirmed'],
            'role' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', __('Whoops, Something Went Wrong'));
        }
    }
}
