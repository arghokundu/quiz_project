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
                    <div class="kpi-value">{{$totalQuiz}}</div>
                    <div class="small text-muted">Across active {{$totalQuiz}}
                        categories</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <strong class="text-success"></strong> Ready • {{$totalQuiz}}
                        <strong class="text-warning"></strong> categories
                    </span>
                    <a href="#" class="text-primary text-decoration-none fw-semibold">
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
                    <div class="kpi-value">{{$totalMcqs}}</div>
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
                    <div class="kpi-value">{{$totalCatagory}}</div>
                    <div class="small text-muted"> with quizzes,
                        open</div>
                </div>
                <div class="kpi-footer">
                    <span>
                        <i class="fa-solid fa-folder-tree text-warning me-1"></i>
                        Full Subject Tree
                    </span>
                    <a href="#" class="text-warning text-decoration-none fw-semibold">
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
                    <div class="kpi-value">80%</div>
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
            </div>
            <!-- Category Cards Grid -->
            <div id="quizGridView" class="row g-4 py-3">
                @forelse($categories as $cat)
                <div class="col-12 col-md-6 col-xl-4 quiz-item-card">
                    <div class="category-card h-70">
                        <!-- Card Top Accent -->
                        <div class="category-card-accent"></div>
                        <div class="p-4">
                            <!-- Header -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="category-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                                <span class="status-pill ready">
                                    <span class="status-dot"></span> Category
                                </span>
                            </div>
                            <!-- Category Information -->
                            <div class="category-information">
                                <span class="category-label">
                                    QUIZ CATEGORY
                                </span>
                                <h4 class="category-title text-truncate mt-2 mb-2">
                                    {{ $cat->category_name }}
                                </h4>
                                <p class="category-description mb-0">
                                    Manage questions and organize your quiz content.
                                </p>
                            </div>
                            <!-- Category Details -->
                            <!-- <div class="category-details mt-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="detail-icon">
                                            <i class="fa-solid fa-list-check"></i>
                                        </div>
                                        <span class="detail-label">
                                            Question Bank
                                        </span>
                                    </div>
                                    <span class="question-bank-label">
                                        Manage Questions
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <!-- Footer Actions -->
                        <div class="category-card-footer">
                            <a href="#" class="btn-category-primary" title="View and Manage MCQs">
                                <i class="fa-solid fa-layer-group me-2"></i>
                                Explore Quizes
                                <i class="fa-solid fa-arrow-right ms-auto"></i>
                            </a>
                            <a href="#" class="btn-category-view" title="View Category Details">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div class="col-12">
                    <div class="category-empty-state text-center py-5">
                        <div class="empty-icon mx-auto mb-3">
                            <i class="fa-regular fa-folder-open"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            No Categories Found
                        </h5>
                        <p class="text-muted mb-0">
                            There are no quiz categories available right now.
                            Create your first category to get started.
                        </p>
                    </div>
                </div>
                @endforelse
            </div>

        </div>
        <div class="dash-card-header bg-light border-0 py-2 px-4">
            <small class="text-muted">
                <i class="fa-solid fa-circle-info me-1"></i>
                Showing # quizzes. Switch between Card Grid and List View anytime.
            </small>
            <a href="#" class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold">
                Go to Full Quiz Directory <i class="fa-solid fa-chevron-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
@endsection