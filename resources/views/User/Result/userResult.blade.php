@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-5 user-result-page">
    <div class="result-card mx-auto">
        {{-- Trophy Section --}}
        <div class="result-trophy">
            <div class="trophy-circle">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <h2>Quiz Completed!</h2>
            <p>Congratulations! You have successfully completed your assessment.</p>
        </div>
        {{-- Score Section --}}
        <div class="result-score-section">
            <div class="score-circle">
                <div class="score-content">
                    <h1>{{--{{ $correctAnswers ?? 0 }}/{{ $totalQuestions ?? 0 }}--}}</h1>
                    <span>Total Score</span>
                </div>
            </div>
            <h3>Great Effort!</h3>
            <p>You scored <strong>{{--{{ $percentage ?? 0 }}--}}%</strong> in this quiz.</p>
        </div>
        {{-- Result Statistics --}}
        <div class="row g-3 result-statistics">
            <div class="col-12 col-md-4">
                <div class="stat-box correct-stat">
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3>{{--{{ $correctAnswers ?? 0 }}--}}</h3>
                    <span>Correct Answers</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="stat-box wrong-stat">
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <h3>{{--{{ $wrongAnswers ?? 0 }}--}}</h3>
                    <span>Wrong Answers</span>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="stat-box skipped-stat">
                    <div class="stat-icon">
                        <i class="fa-solid fa-circle-minus"></i>
                    </div>
                    <h3>{{--{{ $unanswered ?? 0 }}--}}</h3>
                    <span>Unanswered</span>
                </div>
            </div>
        </div>
        {{-- Action Buttons --}}
        <div class="result-actions">
            <a href="#" class="btn btn-retake">
                <i class="fa-solid fa-rotate-right me-2"></i>
                Retake Quiz
            </a>
            <a href="/" class="btn btn-dashboard">
                <i class="fa-solid fa-house me-2"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection