@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-4">
    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="fa-solid fa-layer-group text-primary me-2"></i>
                View MCQ
            </h3>
        </div>
        <a href="/showAll/mcq/{{$quizDtl->quiz_id}}" class="btn btn-outline-secondary mt-3 mt-md-0">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back to MCQ List
        </a>
    </div>
    {{-- MCQ Form Card --}}
    <div class="card border-0 shadow-sm rounded-4 mx-auto" style="max-width: 1300px; width: 100%;">
        <div class="card-header bg-white border-bottom px-4 py-3 rounded-top-4">
            <h5 class="fw-semibold mb-1">
                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>
                MCQ Information
            </h5>
            <small class="text-muted">
                Select a category and quiz, then enter the question and options.
            </small>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6">
                    <label for="categoryName" class="form-label fw-semibold">
                        Category Name <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fa-solid fa-tag text-secondary"></i>
                        </span>
                        <input type="text" class="form-control" id="categoryName" name="categoryName"
                            placeholder="Enter option D"
                            value="{{old('categoryName',$McqData->category->category_name ?? 'Na' ) }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label for="quizName" class="form-label fw-semibold">
                        Quiz Name <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fa-solid fa-book text-secondary"></i>
                        </span>
                        <input type="text" class="form-control" id="quizName" name="quizName"
                            placeholder="Enter option D" value="{{old('quizName',$McqData->quiz->Quiz_Name ?? 'Na' )}}"
                            readonly>
                    </div>
                </div>
            </div>
            <div id="questionSection">
                <h5 class="fw-bold text-dark mb-4">
                    <i class="fa-solid fa-circle-question text-primary me-2"></i>
                    Question Details
                </h5>
                <div class="mb-4">
                    <label for="Question_Name" class="form-label fw-semibold">
                        Question <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control" id="Question_Name" name="Question_Name" rows="3"
                        placeholder="Write your question here..."
                        readonly>{{ old('Question_Name', $McqData->Question_Name) }}</textarea>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label for="optionA" class="form-label fw-semibold">
                            Option A <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="option_A" name="option_A"
                            placeholder="Enter option A" value="{{old('option_A',$McqData->optionA)}}" readonly>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="optionB" class="form-label fw-semibold">
                            Option B <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="option_B" name="option_B"
                            placeholder="Enter option B" value="{{old('option_B',$McqData->optionB)}}" readonly>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12 col-md-6">
                        <label for="optionC" class="form-label fw-semibold">
                            Option C <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="option_C" name="option_C"
                            placeholder="Enter option C" value="{{old('option_C',$McqData->optionC)}}" readonly>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="optionD" class="form-label fw-semibold">
                            Option D <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="option_D" name="option_D"
                            placeholder="Enter option D" value="{{old('option_D',$McqData->optionD)}}" readonly>
                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <label for="correctAnswer" class="form-label fw-semibold">
                        Correct Answer <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="correct_answer" name="correct_answer"
                        placeholder="Enter option D" value="{{old('correct_answer',$McqData->correct_Answer)}}"
                        readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection