<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class quizRequest extends FormRequest
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
        $quizId = $this->route('quizId');

        return [
            'categoryName'=>'required | numeric',
            'quizName' => [
                'required',
                'min:2',
                'max:30',
                'regex:/^[A-Za-z0-9 ]+$/',
                Rule::unique('quizs', 'Quiz_Name')->ignore($quizId, 'quiz_id'),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'categoryName.required'=>'Category name is required',
            'quizName.required'=>'QuizName name is required',
            'quizName.min'=>'QuizName name minimum 2 character required',
            'quizName.max'=>'QuizName name maximum 30 character',
            'quizName.regex'=>'QuizName name not allow special character',
            'quizName.unique'=>'Quiz Name Already Exists',
        ];
    }
}
