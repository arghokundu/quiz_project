<?php

namespace App\Http\Controllers\Mcq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use  App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;
use App\Http\Requests\Mcq\mcqRequest;

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
    public function mcqAddForm($quizId)
    {
        $quizDtl=QuizModel::select('quiz_id','Quiz_Name','cat_id_fk')->where('quiz_id','=',$quizId)->firstOrFail();
        $categoryDtl=CategoryModel::select('cat_id','category_name')->where('cat_id','=',$quizDtl->cat_id_fk)->firstOrFail();
        return view('Mcq.addMcq',compact('categoryDtl','quizDtl'));
    }
    public function storeMcqQuestions(mcqRequest $req,$quizId)
    {
        DB::beginTransaction();
        try
        {
            $reqMcqQuestion=strtoupper($req->Question_Name);
            $quizDtl=QuizModel::select('quiz_id','Quiz_Name','cat_id_fk')->where('quiz_id','=',$quizId)->firstOrFail();
            $checkMcqData=McqModel::with('admin','quiz','category')
                ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
                'quiz_id_fk','cat_id_fk','admin_id_fk')
                ->where('quiz_id_fk','=',$quizDtl->quiz_id)
                ->Where('Question_Name','=',$reqMcqQuestion)
                ->exists();
            if($checkMcqData)
            {
                DB::rollback();
                return back()->with('error','Question already exists');
            }
            $mcqDtls=new McqModel();
            $mcqDtls->Question_Name=$reqMcqQuestion;
            $mcqDtls->optionA=$req->option_A;
            $mcqDtls->optionB=$req->option_B;
            $mcqDtls->optionC=$req->option_C;
            $mcqDtls->optionD=$req->option_D;
            $mcqDtls->correct_Answer=$req->correct_answer;
            $mcqDtls->quiz_id_fk=$req->quizName;
            $mcqDtls->cat_id_fk=$req->categoryName;
            $mcqDtls->admin_id_fk=session('adminId');
            $mcqDtls=$mcqDtls->save();
            if($mcqDtls)
            {
                DB::commit();
                return redirect('/showAll/mcq/'.$quizDtl->quiz_id)->with('success','question creation done');
            } 
            else
            {
                DB::rollback();
                return back()->with('error','something went wrong');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
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
