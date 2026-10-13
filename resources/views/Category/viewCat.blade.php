@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-4">
    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="fa-solid fa-layer-group text-primary me-2"></i>
                View Category
            </h3>
        </div>
        <a href="/showAllCategory" class="btn btn-outline-secondary mt-3 mt-md-0">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Categories
        </a>
    </div>
    {{-- Category Form Card --}}
    <div class="card border-0 shadow-sm rounded-4 mx-auto" style="max-width: 850px;">
        <div class="card-header bg-white border-bottom px-4 py-3 rounded-top-4">
            <h5 class="fw-semibold mb-1">
                <i class="fa-solid fa-pen-to-square text-primary me-2"></i>
                Category Information
            </h5>
            <small class="text-muted">
                Enter the category details below.
            </small>
        </div>
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <label for="categoryName" class="form-label fw-semibold">
                    Category Name
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fa-solid fa-tag text-secondary"></i>
                    </span>
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                        value="{{old('categoryName',$viewCate->category_name)}}" required readonly>
                </div>
            </div>
            <div class="mb-4">
                <label for="categoryName" class="form-label fw-semibold">
                    Category Creater Name
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-light">
                        <i class="fa-solid fa-tag text-secondary"></i>
                    </span>
                    <input type="text" class="form-control" id="createrName" name="createrName"
                        value="{{old('createrName',$viewCate->creater)}}" required readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection