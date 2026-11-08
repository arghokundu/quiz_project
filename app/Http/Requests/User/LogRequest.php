<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LogRequest extends FormRequest
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
            'user_email'=>'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'User_password'=>'required|regex:/^[A-Za-z]{3}[@&#][0-9]*$/',
        ];
    }
    public function messages(): array
    {
        return [
            // User Email
            'user_email.required' => 'Email address is required.',
            'user_email.email' => 'Please enter a valid email address.',
            'user_email.max' => 'Email cannot exceed 255 characters.',
            'user_email.regex' => 'Please enter a valid email format.',
            'user_email.unique' => 'This email address is already registered.',
            // Password
            'User_password.required' => 'Password is required.',
            'User_password.regex' => 'Password must contain exactly 3 letters, followed by one special character (@, & or #), followed by digits.',
        ];
    }
}
