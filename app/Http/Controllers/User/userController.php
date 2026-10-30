<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;

class userController extends Controller
{
    public function dashBoard()
    {
        $totalCatagory = CategoryModel::count('cat_id');
        $totalQuiz = QuizModel::count('quiz_id');
        $totalMcqs = McqModel::count('mcq_id');
        $categories=CategoryModel::select('cat_id','category_name')->get();
        return view('User.userDashboard.userDash',compact('totalCatagory','totalQuiz','totalMcqs','categories'));
    }
}
