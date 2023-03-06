<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'email' => 'required|string|max:60|email|unique:users',
            'password' => 'required|string|min:6|max:60',
            'points' => 'required|integer|max:10000',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'first_name' => 'First name is required',
            'last_name' => 'Last name is required',
            'email.points' => 'Points is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'email.unique' => 'The user with the specified email address is already registered',
        ];
    }
}
