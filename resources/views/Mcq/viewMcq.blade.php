@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-4 mcq-view-page">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-2">
                <i class="fa-solid fa-circle-question text-primary me-2"></i>
                MCQ Details
            </h3>
            <p class="text-muted mb-0">
                Review question details, answer options, and the correct answer.
            </p>
        </div>
        <a href="/showAll/mcq/{{ $quizDtl->quiz_id }}"
           class="btn btn-outline-secondary rounded-3 px-4 py-2">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back to MCQ List
        </a>
    </div>
    <div class="card mcq-detail-card border-0 shadow-sm rounded-4 mx-auto overflow-hidden">
        <div class="card-header bg-white border-bottom px-4 px-md-5 py-4">
            <div class="d-flex align-items-center gap-3">
                <div class="mcq-header-icon rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-file-circle-question fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Question Overview</h5>
                    <p class="text-muted small mb-0">
                        MCQ information and answer details
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="mcq-section-heading mb-3">
                <h6 class="fw-bold text-uppercase text-secondary small mb-0">
                    <i class="fa-solid fa-circle-info me-2 text-primary"></i>
                    Quiz Information
                </h6>
            </div>
            <div class="row g-3 mb-5">
                <div class="col-12 col-md-6">
                    <div class="mcq-info-box border rounded-3 p-3 h-100">
                        <label class="text-muted small fw-semibold mb-2">
                            Category Name
                        </label>
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-tag text-primary mt-1"></i>
                            <span class="fw-semibold text-dark mcq-break-text">
                                {{ $McqData->category->category_name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mcq-info-box border rounded-3 p-3 h-100">
                        <label class="text-muted small fw-semibold mb-2">
                            Quiz Name
                        </label>
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-book-open text-primary mt-1"></i>
                            <span class="fw-semibold text-dark mcq-break-text">
                                {{ $McqData->quiz->Quiz_Name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="mcq-question-label">Q</span>
                <h5 class="fw-bold text-dark mb-0">Question Details</h5>
            </div>
            <div class="mcq-question-box border rounded-4 p-4 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary small fw-bold text-uppercase">
                        Question
                    </span>
                    <i class="fa-solid fa-quote-right text-primary mcq-quote-icon"></i>
                </div>
                <div class="mcq-question-text text-dark fw-semibold">{{ $McqData->Question_Name }}</div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h5 class="fw-bold text-dark mb-0">
                    <i class="fa-solid fa-list-ul text-primary me-2"></i>
                    Answer Options
                </h5>
                <span class="badge bg-light text-secondary border px-3 py-2">
                    <i class="fa-solid fa-list-check me-1"></i>
                    4 Options
                </span>
            </div>
            <div class="row g-3 mb-5">
                <div class="col-12 col-md-6">
                    <div class="mcq-option-card border rounded-3 p-3 h-100 d-flex align-items-start gap-3">
                        <span class="mcq-option-letter">A</span>
                        <div class="mcq-option-text text-dark">{{ $McqData->optionA }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mcq-option-card border rounded-3 p-3 h-100 d-flex align-items-start gap-3">
                        <span class="mcq-option-letter">B</span>
                        <div class="mcq-option-text text-dark">{{ $McqData->optionB }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mcq-option-card border rounded-3 p-3 h-100 d-flex align-items-start gap-3">
                        <span class="mcq-option-letter">C</span>
                        <div class="mcq-option-text text-dark">{{ $McqData->optionC }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mcq-option-card border rounded-3 p-3 h-100 d-flex align-items-start gap-3">
                        <span class="mcq-option-letter">D</span>
                        <div class="mcq-option-text text-dark">{{ $McqData->optionD }}</div>
                    </div>
                </div>
            </div>
            <div class="mcq-correct-answer border rounded-4 p-4">
                <div class="d-flex flex-wrap align-items-start gap-3">
                    <div class="mcq-correct-icon rounded-circle bg-success text-white d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-check fs-5"></i>
                    </div>
                    <div class="flex-grow-1 mcq-answer-content">
                        <div class="text-success fw-bold mb-2">
                            Correct Answer
                        </div>
                        <div class="text-dark fw-semibold fs-5 mcq-break-text">
                           OPTION " {{ $McqData->correct_Answer }} "
                        </div>
                        <small class="text-muted d-block mt-2">
                            This is the answer marked as correct for this question.
                        </small>
                    </div>
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        <i class="fa-solid fa-check-circle me-1"></i>
                        Verified
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
