<?php

namespace App\Http\Controllers\Mcq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use  App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;

class mcqController extends Controller
{
    public function quizAllShowList(Request $r)
    {
        $quizData=QuizModel::with('category')->select('quiz_id','Quiz_Name','cat_id_fk');
        if($r->filled('searchQuiz'))
        {
            $quizData->where('Quiz_Name','ilike','%'.$r->searchQuiz.'%');
        }
        $quizData=$quizData->paginate(5)->withQueryString();
        return view('Mcq.catQuizMcq',compact('quizData'));
    }
    public function mcqAllShowList(Request $r,$quizId)
    {
        $quizData=QuizModel::select('quiz_id','Quiz_Name')->where('quiz_id','=',$quizId)->first();

        $allMcqData=McqModel::with('admin','quiz','category')
            ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
            'quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('quiz_id_fk','=',$quizId);

        if($r->filled('searchMcq'))
        {
            $allMcqData->where('Question_Name','ilike','%'.$r->searchMcq.'%');
        }
        $allMcqData=$allMcqData->paginate(5)->withQueryString();
        return view('Mcq.allMcq',compact('allMcqData','quizData'));
    }
    public function mcqAddForm()
    {
        return view('Mcq.addMcq');
    }
    public function mcqEditForm()
    {
        return view('Mcq.editMcq');
    }
    public function mcqViewForm()
    {
        return view('Mcq.viewMcq');
    }
}
