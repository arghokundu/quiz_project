@extends('layouts.mainApp')
@section('main_content')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid px-3 px-md-4 py-4">
    <!-- ================================================================
         1. HERO BANNER & GREETING
         ================================================================ -->
    <div class="dashboard-hero">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <div class="hero-welcome-badge">
                    <i class="fa-solid fa-bolt-lightning text-warning"></i>
                    <span>Quiz Management System • Admin Portal</span>
                </div>
                <h1 class="hero-title">
                    Welcome back, {{ session('adminName') ? ucfirst(session('adminName')) : 'Administrator' }}!
                </h1>
                <p class="hero-subtitle">
                    Here is what's happening across your quiz ecosystem today. Monitor your quizzes, category
                    distribution, and MCQ question bank at a glance.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="hero-actions justify-content-lg-end">
                    <a href="/add/Quiz" class="btn btn-primary rounded-3 px-3 py-2 fw-semibold shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Add Quiz
                    </a>
                    <a href="/categoryAdd" class="btn btn-outline-secondary rounded-3 px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-folder-plus me-1"></i> Add Category
                    </a>
                    <a href="/showAllQuiz/mcq" class="btn btn-outline-primary rounded-3 px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-circle-question me-1"></i> MCQ Bank
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================================================
         2. KPI METRIC CARDS
         ================================================================ -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Card 1: Total Quizzes -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card primary">
                <div>
                    <div class="kpi-header">
                        <span class="kpi-title">Total Quizzes</span>
                        <div class="kpi-icon primary">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                    </div>
                    <div class="kpi-value">{{ $totalQuizzes }}</div>
                    <div class="small text-muted">Across {{ $categories->where('quiz_count', '>', 0)->count() }} active
                        categories</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <strong class="text-success">{{ $quizzesWithQuestions }}</strong> Ready •
                        <strong class="text-warning">{{ $quizzesPendingQuestions }}</strong> Draft
                    </span>
                    <a href="/showAllQuiz" class="text-primary text-decoration-none fw-semibold">
                        View <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2: Total MCQs -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card success">
                <div>
                    <div class="kpi-header">
                        <span class="kpi-title">Total Questions (MCQ)</span>
                        <div class="kpi-icon success">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                    </div>
                    <div class="kpi-value">{{ $totalMcqs }}</div>
                    <div class="small text-muted">Active questions in question bank</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <i class="fa-solid fa-check-circle text-success me-1"></i>
                        Avg {{ $quizzesWithQuestions > 0 ? round($totalMcqs / $quizzesWithQuestions, 1) : 0 }} / active
                        quiz
                    </span>
                    <a href="/showAllQuiz/mcq" class="text-success text-decoration-none fw-semibold">
                        Manage <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3: Categories -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card warning">
                <div>
                    <div class="kpi-header">
                        <span class="kpi-title">Categories Catalog</span>
                        <div class="kpi-icon warning">
                            <i class="fa-solid fa-shapes"></i>
                        </div>
                    </div>
                    <div class="kpi-value">{{ $totalCategories }}</div>
                    <div class="small text-muted">{{ $categories->where('quiz_count', '>', 0)->count() }} with quizzes,
                        {{ $categories->where('quiz_count', 0)->count() }} open</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <i class="fa-solid fa-folder-tree text-warning me-1"></i>
                        Full Subject Tree
                    </span>
                    <a href="/showAllCategory" class="text-warning text-decoration-none fw-semibold">
                        Browse <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Card 4: Quiz Readiness Rate -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="kpi-card info">
                <div>
                    <div class="kpi-header">
                        <span class="kpi-title">System Readiness</span>
                        <div class="kpi-icon info">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="kpi-value">{{ $readinessRate }}%</div>
                    <div class="small text-muted">{{ $quizzesWithQuestions }} of {{ $totalQuizzes }} quizzes have MCQs
                        ready</div>
                </div>
                <div class="kpi-footer flex-column align-items-stretch gap-2">
                    <div class="custom-progress w-100">
                        <div class="custom-progress-bar bg-info" style="width: {{ $readinessRate }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================================================
         3. CHARTS ROW (Visual Analytics)
         ================================================================ -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Chart 1: Questions per Quiz Bar Chart -->
        <div class="col-12 col-lg-7">
            <div class="dash-card h-100 mb-0">
                <div class="dash-card-header">
                    <h2 class="dash-card-title">
                        <i class="fa-solid fa-chart-simple text-primary"></i>
                        Question Volume by Quiz
                    </h2>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                        {{ $totalQuizzes }} Total Quizzes
                    </span>
                </div>
                <div class="dash-card-body">
                    <p class="text-muted small mb-3">
                        Distribution of MCQs across quizzes. Quizzes with zero questions require new question entries.
                    </p>
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="quizBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Category Distribution Doughnut Chart -->
        <div class="col-12 col-lg-5">
            <div class="dash-card h-100 mb-0">
                <div class="dash-card-header">
                    <h2 class="dash-card-title">
                        <i class="fa-solid fa-chart-pie text-info"></i>
                        Quizzes by Category
                    </h2>
                    <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2">
                        Category Share
                    </span>
                </div>
                <div class="dash-card-body d-flex flex-column justify-content-between">
                    <div style="position: relative; height: 220px; width: 100%; margin: 0 auto;">
                        <canvas id="categoryPieChart"></canvas>
                    </div>
                    <div class="mt-3 pt-3 border-top d-flex justify-content-around text-center">
                        <div>
                            <div class="fw-bold text-dark fs-5">{{ $categories->where('quiz_count', '>', 0)->count() }}
                            </div>
                            <div class="text-muted small">Active Subjects</div>
                        </div>
                        <div class="vr"></div>
                        <div>
                            <div class="fw-bold text-dark fs-5">{{ $totalQuizzes }}</div>
                            <div class="text-muted small">Assigned Quizzes</div>
                        </div>
                        <div class="vr"></div>
                        <div>
                            <div class="fw-bold text-dark fs-5">{{ $totalMcqs }}</div>
                            <div class="text-muted small">Total Questions</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================================================
         4. INTERACTIVE QUIZZES SHOWCASE & STUDIO
         ================================================================ -->
    <div class="dash-card mb-4">
        <div class="dash-card-body pb-3">
            <!-- Spotlight Featured Banner -->
            @php
            $spotlightQuiz = $allQuizzes->firstWhere('mcq_count', '>', 0);
            @endphp
            @if($spotlightQuiz)
            <div class="spotlight-banner">
                <div class="d-flex align-items-center gap-3">
                    <div class="spotlight-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge bg-warning text-dark fw-bold" style="font-size: 0.72rem;">TOP READY
                                QUIZ</span>
                            <span class="fw-bold text-dark">{{ $spotlightQuiz->Quiz_Name }}</span>
                            <span
                                class="badge bg-primary-subtle text-primary">{{ $spotlightQuiz->category ? $spotlightQuiz->category->category_name : 'General' }}</span>
                        </div>
                        <div class="text-muted small mt-1">
                            Fully configured with <strong>{{ $spotlightQuiz->mcq_count }} active MCQs</strong>. Ready
                            for student evaluation.
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="/showAll/mcq/{{ Crypt::encrypt($spotlightQuiz->quiz_id) }}"
                        class="btn btn-sm btn-primary rounded-pill px-3">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Manage MCQs
                    </a>
                </div>
            </div>
            @endif

            <!-- 1. CARDS GRID VIEW (Visual & Modern) -->
            <div id="quizGridView" class="row g-3 g-md-4 py-2">
                @forelse($allQuizzes as $quiz)
                @php
                $encryptedId = Crypt::encrypt($quiz->quiz_id);
                $catName = $quiz->category ? $quiz->category->category_name : 'GENERAL';
                $catClass = 'general';
                $catIcon = 'fa-graduation-cap';
                if (stripos($catName, 'CODING') !== false) {
                $catClass = 'coding';
                $catIcon = 'fa-code';
                } elseif (stripos($catName, 'MATH') !== false) {
                $catClass = 'math';
                $catIcon = 'fa-square-root-variable';
                } elseif (stripos($catName, 'DATABASE') !== false) {
                $catClass = 'database';
                $catIcon = 'fa-database';
                }
                $isReady = $quiz->mcq_count > 0;
                $meterPercent = $isReady ? min(100, $quiz->mcq_count * 25) : 0;
                @endphp
                <div class="col-12 col-md-6 col-xl-4 quiz-item-card" data-status="{{ $isReady ? 'ready' : 'pending' }}"
                    data-name="{{ strtolower($quiz->Quiz_Name) }}" data-category="{{ strtolower($catName) }}">
                    <div class="quiz-grid-card {{ $catClass }}">
                        <div class="quiz-card-accent-bar"></div>
                        <div>
                            <!-- Card Header Top -->
                            <div class="quiz-card-top">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="quiz-avatar-icon {{ $catClass }}">
                                        <i class="fa-solid {{ $catIcon }}"></i>
                                    </div>
                                    <span class="cat-tag {{ $catClass }}">
                                        {{ $catName }}
                                    </span>
                                </div>
                                <div>
                                    @if($isReady)
                                    <span class="status-pill ready">
                                        <span class="status-dot"></span> Ready ({{ $quiz->mcq_count }})
                                    </span>
                                    @else
                                    <span class="status-pill pending">
                                        <span class="status-dot"></span> Needs Questions
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Quiz Title & Meta -->
                            <h3 class="quiz-card-title">{{ $quiz->Quiz_Name }}</h3>
                            <div class="quiz-card-meta">
                                <span>•</span>
                                <span><i
                                        class="fa-regular fa-calendar me-1"></i>{{ $quiz->created_at ? $quiz->created_at->format('M d, Y') : 'Recent' }}</span>
                            </div>

                            <!-- Question Readiness Meter -->
                            <div class="quiz-card-meter">
                                <div class="quiz-meter-header">
                                    <span class="text-muted small">
                                        <i class="fa-solid fa-list-ol me-1 text-primary"></i> Question Bank
                                    </span>
                                    <span class="fw-bold {{ $isReady ? 'text-success' : 'text-warning' }}">
                                        {{ $quiz->mcq_count }} {{ $quiz->mcq_count == 1 ? 'Question' : 'Questions' }}
                                    </span>
                                </div>
                                <div class="quiz-meter-bar">
                                    <div class="quiz-meter-fill {{ $isReady ? 'bg-success' : 'bg-warning' }}"
                                        style="width: {{ $isReady ? $meterPercent : '8' }}%;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="quiz-card-actions">
                            <a href="/showAll/mcq/{{ $encryptedId }}" class="btn-card-action btn-card-primary"
                                title="View & Manage MCQs">
                                <i class="fa-solid fa-layer-group"></i> Manage MCQs
                            </a>
                            <a href="/mcq/add/{{ $encryptedId }}" class="btn-card-action btn-card-success"
                                title="Add MCQ Question">
                                <i class="fa-solid fa-plus"></i> Add
                            </a>
                            <a href="/edit/quiz/{{ $encryptedId }}" class="btn-card-icon"
                                title="Edit Quiz Title & Category">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="/viewspecific/quiz/{{ $encryptedId }}" class="btn-card-icon"
                                title="View Quiz Details">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-regular fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">No Quizzes Found</h5>
                    <p class="text-muted small">Get started by creating your very first quiz set.</p>
                    <a href="/add/Quiz" class="btn btn-primary rounded-pill px-4">
                        <i class="fa-solid fa-plus me-1"></i> Add New Quiz
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        <div class="dash-card-header bg-light border-0 py-2 px-4">
            <small class="text-muted">
                <i class="fa-solid fa-circle-info me-1"></i>
                Showing {{ $allQuizzes->count() }} quizzes. Switch between Card Grid and List View anytime.
            </small>
            <a href="/showAllQuiz" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">
                Go to Full Quiz Directory <i class="fa-solid fa-chevron-right ms-1"></i>
            </a>
        </div>
    </div>
    <!-- ================================================================
         5. CATEGORY COVERAGE & ALLOCATION
         ================================================================ -->
    <div class="dash-card mb-4">
        <div class="dash-card-header">
            <h2 class="dash-card-title">
                <i class="fa-solid fa-sitemap text-warning"></i>
                Category Coverage & Allocation
            </h2>
            <div class="d-flex align-items-center gap-2">
                <a href="/categoryAdd" class="btn btn-sm btn-outline-warning rounded-2">
                    <i class="fa-solid fa-plus me-1"></i> New Category
                </a>
                <a href="/showAllCategory" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">
                    View all {{ $totalCategories }} categories <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="dash-card-body">
            <p class="text-muted small mb-3">
                Volume of quizzes and questions organized by category across your subject catalog.
            </p>

            <div class="row g-3 g-md-4">
                @foreach($categories as $cat)
                @php
                $percentage = $totalQuizzes > 0 ? round(($cat->quiz_count / $totalQuizzes) * 100, 1) : 0;
                $colorClass = 'bg-primary';
                if (stripos($cat->category_name, 'MATH') !== false) {
                $colorClass = 'bg-success';
                } elseif (stripos($cat->category_name, 'DATABASE') !== false) {
                $colorClass = 'bg-warning';
                } elseif (stripos($cat->category_name, 'SCIENCE') !== false) {
                $colorClass = 'bg-info';
                }
                @endphp
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="category-progress-item p-3 border rounded-3 bg-light-subtle h-100">
                        <div class="category-progress-header">
                            <div>
                                <span class="fw-bold text-dark">{{ $cat->category_name }}</span>
                                <span class="badge bg-light text-muted ms-1">{{ $cat->quiz_count }} Quizzes</span>
                                @if($cat->mcq_count > 0)
                                <span class="badge bg-success-subtle text-success ms-1">{{ $cat->mcq_count }}
                                    MCQs</span>
                                @endif
                            </div>
                            <span class="text-muted small fw-bold">{{ $percentage }}%</span>
                        </div>
                        <div class="custom-progress">
                            <div class="custom-progress-bar {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- ================================================================
     DASHBOARD CLIENT-SIDE DATA & EXTERNAL JAVASCRIPT
     ================================================================ -->
<script>
// Pass PHP chart datasets cleanly to external dashboard.js
window.dashboardData = {
    categoryChart: @json($categoryChartData),
    quizChart: @json($quizChartData)
};
</script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection