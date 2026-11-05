@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-3">
    <div class="mcq-assessment-wrapper">
        {{-- Quiz Header Card --}}
        <div class="mcq-assessment-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="mcq-badge-category">
                            <i class="fa-solid fa-shapes"></i>
                            {{ $userMcqView->category->category_name ?? 'Quiz Category' }}
                        </span>
                        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                            <i class="fa-solid fa-circle-question text-primary me-1"></i>
                            {{ $currentQuiz['totalMcq'] }} Questions
                        </span>
                    </div>
                    <h2 class="mcq-quiz-title">{{ $userMcqView->quiz->Quiz_Name ?? 'MCQ Assessment' }}</h2>
                    <p class="text-muted small mb-0">
                        <i class="fa-solid fa-info-circle me-1 text-primary"></i>
                        Select your preferred option for each question and submit when completed.
                    </p>
                </div>
            </div>
        </div>
        @if(!$userMcqView)
        {{-- Empty State --}}
        <div class="mcq-empty-container">
            <div class="mcq-empty-icon">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">No Questions Available</h4>
            <p class="text-muted mb-4">
                There are currently no MCQs added to this quiz. Please check back later or explore other quizzes.
            </p>
            <a href="javascript:history.back()" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Back to Quizzes
            </a>
        </div>
        @else
        <form id="mcqAssignmentForm" action="/submit/next/{{$userMcqView->mcq_id}}" method="POST">
            @csrf
            <div class="mcq-question-card" id="">
                <div class="mcq-question-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <span class="mcq-q-num-badge">
                            <i class="fa-solid fa-list-ol"></i>
                            Question {{ $currentQuiz['currentMcq'] }} of {{ $currentQuiz['totalMcq'] }}
                        </span>
                        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill small">
                            Single Choice
                        </span>
                    </div>
                    <h4 class="mcq-q-title">{{ $userMcqView->Question_Name }}</h4>
                </div>
                <div class="mcq-question-body">
                    <div class="mcq-options-grid">
                        {{-- Option A --}}
                        <label class="mcq-option-label" for="">
                            <input type="radio" class="mcq-option-radio" name="optionA" id="optionA">
                            <span class="mcq-opt-letter">A</span>
                            <span class="mcq-opt-text">{{ $userMcqView->optionA }}</span>
                            <span class="mcq-opt-indicator"></span>
                        </label>
                        {{-- Option B --}}
                        <label class="mcq-option-label" for="">
                            <input type="radio" class="mcq-option-radio" name="optionA" id="optionA">
                            <span class="mcq-opt-letter">B</span>
                            <span class="mcq-opt-text">{{ $userMcqView->optionB }}</span>
                            <span class="mcq-opt-indicator"></span>
                        </label>
                        {{-- Option C --}}
                        <label class="mcq-option-label" for="">
                            <input type="radio" class="mcq-option-radio" name="optionA" id="optionA">
                            <span class="mcq-opt-letter">C</span>
                            <span class="mcq-opt-text">{{ $userMcqView->optionC }}</span>
                            <span class="mcq-opt-indicator"></span>
                        </label>
                        {{-- Option D --}}
                        <label class="mcq-option-label" for="">
                            <input type="radio" class="mcq-option-radio" name="optionA" id="optionA">
                            <span class="mcq-opt-letter">D</span>
                            <span class="mcq-opt-text">{{ $userMcqView->optionD }}</span>
                            <span class="mcq-opt-indicator"></span>
                        </label>
                    </div>
                </div>
            </div>
            {{-- Navigation Buttons --}}
            <div class="mcq-controls-footer">
                <div class="d-flex align-items-center gap-3">
                    @if($currentQuiz['currentMcq'] < $currentQuiz['totalMcq']) 
                        {{-- Next Button --}} 
                        <button type="submit" name="action" value="next" class="mcq-btn-action mcq-btn-next">
                            <span>Next</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        @else
                        {{-- Final Submit Button --}}
                        <button type="submit" name="action" value="finish" class="mcq-btn-action mcq-btn-submit">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Submit Quiz</span>
                        </button>
                    @endif
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection