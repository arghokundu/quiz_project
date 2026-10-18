<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class catRequest extends FormRequest
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
            'categoryName'=>'required|min:2|max:30|regex:/^[A-Za-z0-9 ]+$/|unique:category,category_name',
        ];
    }
    public function messages(): array
    {
        return [
            'categoryName.required'=>'Category name is required',
            'categoryName.min'=>'category name minimum 2 character required',
            'categoryName.max'=>'Category name maximum 30 character',
            'categoryName.regex'=>'category name not allow special character',
        ];
    }
}
