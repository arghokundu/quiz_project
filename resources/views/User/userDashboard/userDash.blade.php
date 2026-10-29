@extends('layouts.mainApp')
@section('main_content')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
<div class="container-fluid px-3 px-md-4 py-4">
    <!-- ================================================================
         1. HERO BANNER & GREETING
         ================================================================ -->
    <div class="dashboard-hero">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <div class="hero-welcome-badge">
                    <i class="fa-solid fa-bolt-lightning text-warning"></i>
                    <span>Quiz Management System </span>
                </div>
                <h1 class="hero-title">
                    Welcome back, User
                </h1>
                <p class="hero-subtitle">
                    Here is what's happening across your quiz ecosystem today. Monitor your quizzes, category
                    distribution, and MCQ question bank at a glance.
                </p>
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
                    <div class="kpi-value"></div>
                    <div class="small text-muted">Across active
                        categories</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <strong class="text-success"></strong> Ready •
                        <strong class="text-warning"></strong> Draft
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
                    <div class="kpi-value"></div>
                    <div class="small text-muted">Active questions in question bank</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <i class="fa-solid fa-check-circle text-success me-1"></i>
                        Avg
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
                    <div class="kpi-value">#</div>
                    <div class="small text-muted"> with quizzes,
                        open</div>
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
                    <div class="kpi-value">%</div>
                    <div class="small text-muted"> of quizzes have MCQs
                        ready</div>
                </div>
                <div class="kpi-footer flex-column align-items-stretch gap-2">
                    <div class="custom-progress w-100">
                        <div class="custom-progress-bar bg-info" style="width: %"></div>
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
            <div class="spotlight-banner">
                <div class="d-flex align-items-center gap-3">
                    <div class="spotlight-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge bg-warning text-dark fw-bold" style="font-size: 0.72rem;">TOP READY
                                QUIZ</span>
                            <span class="fw-bold text-dark"></span>
                            <span class="badge bg-primary-subtle text-primary"></span>
                        </div>
                        <div class="text-muted small mt-1">
                            Fully configured with <strong> active MCQs</strong>. Ready
                            for student evaluation.
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="" class="btn btn-sm btn-primary rounded-pill px-3">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Manage MCQs
                    </a>
                </div>
            </div>


            <!-- 1. CARDS GRID VIEW (Visual & Modern) -->
            <div id="quizGridView" class="row g-3 g-md-4 py-2">
                <div class="col-12 col-md-6 col-xl-4 quiz-item-card" data-status="" data-name="" data-category="">
                    <div class="quiz-grid-card ">
                        <div class="quiz-card-accent-bar"></div>
                        <div>
                            <!-- Card Header Top -->
                            <div class="quiz-card-top">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="quiz-avatar-icon">
                                        <i class="fa-solid "></i>
                                    </div>
                                    <span class="cat-tag ">

                                    </span>
                                </div>
                                <div>

                                    <span class="status-pill ready">
                                        <span class="status-dot"></span> Ready
                                    </span>

                                    <span class="status-pill pending">
                                        <span class="status-dot"></span> Needs Questions
                                    </span>

                                </div>
                            </div>

                            <!-- Quiz Title & Meta -->
                            <h3 class="quiz-card-title">#</h3>
                            <div class="quiz-card-meta">
                                <span>•</span>
                                <span><i class="fa-regular fa-calendar me-1"></i></span>
                            </div>

                            <!-- Question Readiness Meter -->
                            <div class="quiz-card-meter">
                                <div class="quiz-meter-header">
                                    <span class="text-muted small">
                                        <i class="fa-solid fa-list-ol me-1 text-primary"></i> Question Bank
                                    </span>
                                    <span class="fw-bold ">

                                    </span>
                                </div>
                                <div class="quiz-meter-bar">
                                    <div class="quiz-meter-fill " style="width:"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="quiz-card-actions">
                            <a href="#" class="btn-card-action btn-card-primary" title="View & Manage MCQs">
                                <i class="fa-solid fa-layer-group"></i> Manage MCQs
                            </a>
                            <!-- <a href="#" class="btn-card-action btn-card-success" title="Add MCQ Question">
                                <i class="fa-solid fa-plus"></i> Add
                            </a>
                            <a href="#" class="btn-card-icon" title="Edit Quiz Title & Category">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a> -->
                            <a href="#" class="btn-card-icon" title="View Quiz Details">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center py-5">
                    <i class="fa-regular fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">No Quizzes Found</h5>
                    <p class="text-muted small">Get started by creating your very first quiz set.</p>
                </div>

            </div>
        </div>
        <div class="dash-card-header bg-light border-0 py-2 px-4">
            <small class="text-muted">
                <i class="fa-solid fa-circle-info me-1"></i>
                Showing # quizzes. Switch between Card Grid and List View anytime.
            </small>
            <a href="/showAllQuiz" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">
                Go to Full Quiz Directory <i class="fa-solid fa-chevron-right ms-1"></i>
            </a>
        </div>
    </div>
    <!-- ================================================================
         5. CATEGORY COVERAGE & ALLOCATION
         ================================================================ -->
    <!-- <div class="dash-card mb-4">
        <div class="dash-card-header">
            <h2 class="dash-card-title">
                <i class="fa-solid fa-sitemap text-warning"></i>
                Category Coverage & Allocation
            </h2>
            <div class="d-flex align-items-center gap-2">
                <a href="/showAllCategory" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">
                    View all # categories <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        <div class="dash-card-body">
            <p class="text-muted small mb-3">
                Volume of quizzes and questions organized by category across your subject catalog.
            </p>

            <div class="row g-3 g-md-4">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="category-progress-item p-3 border rounded-3 bg-light-subtle h-100">
                        <div class="category-progress-header">
                            <div>
                                <span class="fw-bold text-dark">#</span>
                                <span class="badge bg-light text-muted ms-1"># Quizzes</span>
                                #
                                <span class="badge bg-success-subtle text-success ms-1">#
                                    MCQs</span>

                            </div>
                            <span class="text-muted small fw-bold"># %</span>
                        </div>
                        <div class="custom-progress">
                            <div class="custom-progress-bar " style="width: #%"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
</div>
@endsection