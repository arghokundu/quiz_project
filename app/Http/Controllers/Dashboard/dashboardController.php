<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz\QuizModel;
use App\Models\Category\CategoryModel;
use App\Models\Mcq\McqModel;

class dashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with optimized database queries.
     * 
     * Optimizations applied:
     * 1. Primary-key counting: count('column_id') counts indexed keys directly.
     * 2. Column selection: select() fetches only required columns to reduce memory.
     * 3. Relationship counting: withCount() executes SQL subselects, eliminating N+1 queries.
     * 4. Eager loading: with() loads related models in a single optimized query.
     */
    public function dashboard()
    {
        // -------------------------------------------------------------
        // 1. Total KPI Counts (Counting only primary key IDs for speed)
        // -------------------------------------------------------------
        $totalQuizzes = QuizModel::count('quiz_id');
        $totalCategories = CategoryModel::count('cat_id');
        $totalMcqs = McqModel::count('mcq_id');

        // -------------------------------------------------------------
        // 2. Fetch Quizzes (Optimized: select() only needed columns)
        // -------------------------------------------------------------
        $allQuizzes = QuizModel::select('quiz_id', 'Quiz_Name', 'cat_id_fk', 'created_at')
            ->with(['category' => function ($query) {
                // Eager-load category name, fetching only cat_id and category_name
                $query->select('cat_id', 'category_name');
            }])
            ->withCount('mcq') // SQL COUNT(*) subquery to avoid N+1 queries
            ->orderBy('quiz_id', 'desc')
            ->get();

        // -------------------------------------------------------------
        // 3. Quiz Readiness Statistics (Calculated from collection)
        // -------------------------------------------------------------
        $quizzesWithQuestions = $allQuizzes->where('mcq_count', '>', 0)->count();
        $quizzesPendingQuestions = $allQuizzes->where('mcq_count', 0)->count();
        $readinessRate = $totalQuizzes > 0 ? round(($quizzesWithQuestions / $totalQuizzes) * 100, 1) : 0;

        // -------------------------------------------------------------
        // 4. Fetch Categories (Optimized: select() only needed columns)
        // -------------------------------------------------------------
        $categories = CategoryModel::select('cat_id', 'category_name', 'creater')
            ->withCount(['quiz', 'mcq']) // Counts related quizzes & mcqs per category
            ->orderBy('quiz_count', 'desc')
            ->get();

        // -------------------------------------------------------------
        // 5. Category Chart Data (Only active categories)
        // -------------------------------------------------------------
        $categoryChartData = [];
        foreach ($categories as $cat) {
            if ($cat->quiz_count > 0 || $cat->mcq_count > 0) {
                $categoryChartData[] = [
                    'name' => $cat->category_name,
                    'quiz_count' => $cat->quiz_count,
                    'mcq_count' => $cat->mcq_count,
                ];
            }
        }

        // -------------------------------------------------------------
        // 6. Quiz Chart Data (Questions per quiz)
        // -------------------------------------------------------------
        $quizChartData = [];
        foreach ($allQuizzes as $q) {
            $quizChartData[] = [
                'name' => $q->Quiz_Name,
                'mcq_count' => $q->mcq_count,
                'category' => $q->category ? $q->category->category_name : 'Uncategorized',
            ];
        }

        // -------------------------------------------------------------
        // 7. Return to View with Clean Compact
        // -------------------------------------------------------------
        return view('dashboard.index', compact(
            'totalQuizzes',
            'totalCategories',
            'totalMcqs',
            'allQuizzes',
            'quizzesWithQuestions',
            'quizzesPendingQuestions',
            'readinessRate',
            'categories',
            'categoryChartData',
            'quizChartData'
        ));
    }
}
