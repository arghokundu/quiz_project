<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class adminLoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'useremail' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'userpassword' => 'required|min:7|max:10|regex:/^[A-Za-z]+[@&-][A-Za-z0-9]*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'useremail.required' => 'Email is required',
            'useremail.regex' => 'Email must be formatted correctly',
            'userpassword.required' => 'Password is required',
            'userpassword.min' => 'Password must be at least 7 characters',
            'userpassword.max' => 'Password cannot exceed 10 characters',
            'userpassword.regex' => 'Password must be formatted correctly, e.g. ABC@123',
        ];
    }
}