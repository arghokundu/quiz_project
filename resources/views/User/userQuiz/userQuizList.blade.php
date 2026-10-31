@extends('layouts.mainApp')
@section('main_content')
<link rel="stylesheet" href="{{ asset('assets/css/userDashb/quizSection.css') }}">
<div class="quiz-page-wrapper">
    <div class="quiz-section-container">
        {{-- Quiz Section Header --}}
        <div class="quiz-section-header">
            <div class="quiz-header-content">
                <span class="quiz-header-label">
                    <i class="fa-solid fa-graduation-cap"></i>
                    LEARNING & ASSESSMENT
                </span>
                <h3 class="quiz-header-title">
                    Explore Quizzes & MCQs
                </h3>
                <p class="quiz-header-subtitle">
                    Discover new challenges, test your skills and improve your knowledge.
                </p>
            </div>
            <div class="quiz-header-icon">
                <i class="fa-solid fa-shapes"></i>
            </div>
        </div>
        {{-- Quiz Cards Section --}}
        <div class="quiz-cards-section">
            <div id="quizGridView" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @forelse($quizes as $quiz)
                <div class="col quiz-card-column">
                    <div class="quiz-category-card h-100">
                        {{-- Card Top --}}
                        <div class="quiz-card-top">
                            <div class="quiz-card-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <span class="quiz-card-status">
                                <span class="quiz-status-indicator"></span>
                                Available
                            </span>
                        </div>
                        {{-- Card Content --}}
                        <div class="quiz-card-content">
                            <span class="quiz-card-label">
                                QUIZ CATEGORY
                            </span>
                            <h4 class="quiz-card-title">
                                {{ $quiz->Quiz_Name }}
                            </h4>
                            <p class="quiz-card-description">
                                Challenge yourself with exciting questions
                                and improve your technical knowledge.
                            </p>
                        </div>
                        {{-- Card Footer --}}
                        <div class="quiz-card-footer">
                            <a href="#" class="quiz-start-button">
                                <span class="quiz-button-text">
                                    <i class="fa-solid fa-circle-play"></i>
                                    Start Assignment
                                </span>
                                <i class="fa-solid fa-arrow-right quiz-button-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Empty State --}}
                <div class="col-12 quiz-empty-column">
                    <div class="quiz-empty-state">
                        <div class="quiz-empty-icon">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                        <h5 class="quiz-empty-title">
                            No Quizzes Found
                        </h5>
                        <p class="quiz-empty-description">
                            There are no quiz categories available right now.
                            Please check again later.
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection