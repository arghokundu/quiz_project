<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class quizController extends Controller
{
    public function quizAllShow()
    {
        return view('Quiz.allQuiz');
    }
    public function quizAdd()
    {
        return view('Quiz.addQuiz');
    }
    public function quizEdit()
    {
        return view('Quiz.editQuiz');
    }
}
