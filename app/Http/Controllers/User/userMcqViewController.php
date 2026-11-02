<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;

class userMcqViewController extends Controller
{
    public function mcqViewList($quizId)
    {
        $userMcqView=McqModel::with('admin','quiz','category')
            ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
            'quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('quiz_id_fk','=',$quizId)->get();
        return view('User.userMcq.userSpecificMcqList',compact('userMcqView'));
    }
}
