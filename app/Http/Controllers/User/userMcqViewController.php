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

        // Store quiz information in session
        $currentQuiz = [
            'totalMcq' => $totalMcq,
            'currentMcq' => 1,
            'quizId' => $quizId,
            'currentMcqId' => $userMcqView->mcq_id
        ];
        Session::put('currentQuiz', $currentQuiz);
        return view('User.userMcq.userSpecificMcqList',compact('userMcqView', 'currentQuiz'));
    }

    // Submit Answer and Fetch Next Question
    public function submitAndNext($mcqId)
    {
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

        // If next question exists
        if ($userMcqView) {
            $currentQuiz['currentMcq']++;
            $currentQuiz['currentMcqId'] = $userMcqView->mcq_id;
            Session::put('currentQuiz', $currentQuiz);
            return view('User.userMcq.userSpecificMcqList',compact('userMcqView', 'currentQuiz'));
        }
        else
        {
            // All questions completed
            return view('User.Result.userResult');
        }
    }
}
