<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Quiz\quizRequest;
use App\Models\Category\CategoryModel;
use  App\Models\Quiz\QuizModel;

class quizController extends Controller
{
    public function quizAllShow(Request $r)
    {
        $quizData=QuizModel::with('category')->select('quiz_id','Quiz_Name','cat_id_fk');
        if($r->filled('searchQuiz'))
        {
            $quizData->where('Quiz_Name','ilike','%'.$r->searchQuiz.'%');
        }
        $quizData=$quizData->paginate(5)->withQueryString();
        return view('Quiz.allQuiz',compact('quizData'));
    }
    public function quizAdd()
    {
        $categoryDetails=CategoryModel::select('cat_id','category_name')->get();
        return view('Quiz.addQuiz',compact('categoryDetails'));
    }
    public function storeQuiz(quizRequest $quizReq)
    {
        DB::beginTransaction();
        try
        {
            $reqQuizname=strtoupper($quizReq->quizName);
            $checkQuizName=QuizModel::select('quiz_id','Quiz_Name','cat_id_fk')
                ->where('Quiz_Name','=', $reqQuizname)->exists();
            if($checkQuizName)
            {
                DB::rollback();
                return back()->with('error','Quiz Name Already Exists');
            }
            $quizData=new QuizModel();
            $quizData->Quiz_Name=$reqQuizname;
            $quizData->cat_id_fk=$quizReq->categoryName;
            $savedQuizData=$quizData->save();
            if($savedQuizData)
            {
                DB::commit();
                return redirect('/showAllQuiz');
            }
            else
            {
                DB::rollback();
                return back()->with('error','something went wrong please check it..');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }
    public function quizEdit()
    {
        return view('Quiz.editQuiz');
    }
}