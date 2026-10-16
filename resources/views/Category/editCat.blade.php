@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-4">
    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="fa-solid fa-layer-group text-primary me-2"></i>
                Edit Category
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
            <form action="/updateCate/{{Crypt::encrypt($editCategory->cat_id)}}" id="categoryForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="categoryName" class="form-label fw-semibold">
                        Category Name <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fa-solid fa-tag text-secondary"></i>
                        </span>
                        <input type="text" class="form-control"
                            id="categoryName" name="categoryName" placeholder="Enter category name" 
                            value="{{old('categoryName',$editCategory->category_name)}}" required>
                    </div>
                    @error('categoryName')
                    <div class="text-danger small mt-2">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <!-- Display message -->
                    @if(session('error'))
                    <p class="text-danger fw-semibold mt-2">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>
                        {{ session('error') }}
                    </p>
                    @endif
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                    <a href="/showAllCategory" class="btn btn-light border px-4 py-2">
                        <i class="fa-solid fa-xmark me-2"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection