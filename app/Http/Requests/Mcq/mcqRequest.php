<?php

namespace App\Http\Requests\Mcq;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class mcqRequest extends FormRequest
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
            'categoryName'=>'required | numeric',
            'quizName'=>'required | numeric',
            'Question_Name'=>'required | min:2 | max:350 | regex:/^[A-Za-z0-9 ]+$/ | unique:mcq,Question_Name',
            'option_A'=>'required | min:2 | max:350 | regex:/^[A-Za-z0-9 ]+$/',
            'option_B'=>'required | min:2 | max:350 | regex:/^[A-Za-z0-9 ]+$/',
            'option_C'=>'required | min:2 | max:350 | regex:/^[A-Za-z0-9 ]+$/',
            'option_D'=>'required | min:2 | max:350 | regex:/^[A-Za-z0-9 ]+$/',
            'correct_answer'=>'required | in:A,B,C,D',
        ];
    }
    public function messages(): array
    {
         return [
            'categoryName.required' => 'Please select a category.',
            'quizName.required' => 'Please select a quiz.',
            'Question_Name.required' => 'Please enter the question.',
            'Question_Name.unique' => 'This question already exists in the selected quiz.',
            'option_A.required' => 'Please enter Option A.',
            'option_B.required' => 'Please enter Option B.',
            'option_C.required' => 'Please enter Option C.',
            'option_D.required' => 'Please enter Option D.',
            'correct_answer.required' => 'Please select the correct answer.',
        ];
    }
}
