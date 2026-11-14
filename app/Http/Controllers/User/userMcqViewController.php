<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category\CategoryModel;
use App\Models\Quiz\QuizModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Mcq\McqModel;
use App\Models\User\userRecordModel;
use App\Models\User\userAttemptModel;

class userMcqViewController extends Controller
{
    // Start Quiz
    public function mcqViewList($quizId)
    {
        // Count total questions
        $totalMcq = McqModel::select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
            'quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('quiz_id_fk', $quizId)
            ->count('mcq_id');

        if ($totalMcq == 0) {
            return back()->with('error', 'No questions available.');
        }
        // Fetch only first question
        $userMcqView = McqModel::with('quiz', 'category')
            ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
                'quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('quiz_id_fk', $quizId)
            ->orderBy('mcq_id', 'asc')
            ->first();
        
        //===================user Record details save ========== 
        DB::beginTransaction();
        try
        {
            $userRecords= new userRecordModel();
            $userRecords->quiz_id_fk=$quizId;
            $userRecords->user_id_fk=session('userId');
            $userRecords->status=1;
            $saveUserRecords=$userRecords->save();
            if($saveUserRecords)
            {
                DB::commit();
                // Store quiz information in session
                $currentQuiz = [
                    'totalMcq' => $totalMcq,
                    'currentMcq' => 1,
                    'quizId' => $quizId,
                    'currentMcqId' => $userMcqView->mcq_id,
                    'userRecordId'=>$userRecords->userRecord_id,
                ];
                Session::put('currentQuiz', $currentQuiz);
                return view('User.userMcq.userSpecificMcqList',compact('userMcqView', 'currentQuiz'));
            }
            else
            {
                return back()->with('error','No record save');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }
    // Display Next Question
    public function showQuestion($mcqId)
    {
        $currentQuiz = Session::get('currentQuiz');
        if (!$currentQuiz) 
        {
            return redirect('/')->with('error', 'Quiz session expired.');
        }
        $userMcqView = McqModel::with('quiz', 'category')
            ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('mcq_id', $mcqId)
            ->where('quiz_id_fk', $currentQuiz['quizId'])
            ->first();
        if (!$userMcqView) 
        {
            return redirect('/')->with('error', 'Invalid question.');
        }
        return view('User.userMcq.userSpecificMcqList',compact('userMcqView', 'currentQuiz'));
    }
    // Submit Answer and Fetch Next Question
    public function submitAndNext(Request $mcqUserReq,$mcqId)
    {
        // Validate answer
        $mcqUserReq->validate([
            'userAnswerOption' => 'required|in:A,B,C,D'
        ]);

        $currentQuiz = Session::get('currentQuiz');
        if (!$currentQuiz) {
            return redirect('/')->with('error', 'Quiz session expired.');
        }
        
        // Fetch next question
        $userMcqView = McqModel::with('quiz', 'category')
            ->select('mcq_id','Question_Name','optionA','optionB','optionC','optionD','correct_Answer',
                'quiz_id_fk','cat_id_fk','admin_id_fk')
            ->where('quiz_id_fk', $currentQuiz['quizId'])
            ->where('mcq_id', '>', $mcqId)
            ->orderBy('mcq_id', 'asc')
            ->first();

        // Fetch current question for answer checking
        $currentMcqView = McqModel::select('mcq_id','correct_Answer','Question_Name','optionA','optionB','optionC','optionD',)
            ->where('mcq_id', $mcqId)
            ->where('quiz_id_fk', $currentQuiz['quizId'])
            ->first();
        if (!$currentMcqView) 
        {
            return back()->with('error', 'Invalid question.');
        }

        DB::beginTransaction();
        try
        {
            $attempts=new userAttemptModel();  
            $attempts->userSelect_Ans=$mcqUserReq->userAnswerOption;
            $attempts->user_id_fk=session('userId');
            $attempts->userRecord_id_fk=$currentQuiz['userRecordId']; 
            $attempts->mcq_id_fk=$mcqId; 
            if($mcqUserReq->userAnswerOption == $currentMcqView->correct_Answer )
            {
                $attempts->correct_ans=1;
            }
            else
            {
                $attempts->correct_ans=0;
            }
            $savedAttemptsMcqAns=$attempts->save();
            if($savedAttemptsMcqAns)
            {
                DB::commit();
                // If next question exists
                if ($userMcqView) {
                    $currentQuiz['currentMcq']++;
                    $currentQuiz['currentMcqId'] = $userMcqView->mcq_id;
                    Session::put('currentQuiz', $currentQuiz);
                    // return view('User.userMcq.userSpecificMcqList',compact('userMcqView', 'currentQuiz'));
                    return redirect('/user/mcq/question/' . $userMcqView->mcq_id);
                }
                else
                {
                    // All questions completed
                    return view('User.Result.userResult');
                }
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
    }
}
