<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegRequest extends FormRequest
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
            'User_Name'=>'required|min:2|max:30|regex:/^[A-Za-z ]+$/ ',
            'User_Email'=>'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:user_details,userEmail',
            'user_Password'=>'required|regex:/^[A-Za-z]{3}[@&#][0-9]*$/|confirmed',
        ];
    }
    public function messages()
    {
        return [
            // User Name
            'User_Name.required' => 'User name is required.',
            'User_Name.min' => 'User name must contain at least 2 characters.',
            'User_Name.max' => 'User name cannot exceed 30 characters.',
            'User_Name.regex' => 'User name can contain letters.',
            // User Email
            'User_Email.required' => 'Email address is required.',
            'User_Email.email' => 'Please enter a valid email address.',
            'User_Email.max' => 'Email cannot exceed 255 characters.',
            'User_Email.regex' => 'Please enter a valid email format.',
            'User_Email.unique' => 'This email address is already registered.',
            // Password
            'user_Password.required' => 'Password is required.',
            'user_Password.regex' => 'Password must contain exactly 3 letters, followed by one special character (@, & or #), followed by digits.',
        ];
    }
}
