<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;

class userQuizController extends Controller
{
    public function userQuizView($catId)
    {
        $quizes=QuizModel::with('category')
            ->select('quiz_id','Quiz_Name','cat_id_fk')
            ->where('cat_id_fk','=',$catId)
            ->get();
        return view('User.userQuiz.userQuizList',compact('quizes'));
    }
}
