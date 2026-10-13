@extends('layouts.mainApp')
@section('main_content')
<div class="container-fluid px-3 px-md-4 py-4">
    <!-- {{-- Page Header --}} -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="fa-solid fa-layer-group text-primary me-2"></i>
                Category Management
            </h3>
        </div>
        <a href="/categoryAdd" class="btn btn-primary rounded-3 px-4 mt-3 mt-md-0">
            <i class="fa-solid fa-plus me-2"></i>
            Add New Category
        </a>
    </div>
    <!-- {{-- Main Card --}} -->
    <div class="card border-0 shadow-sm rounded-4">
        <!-- {{-- Card Header --}} -->
        <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h5 class="fw-bold mb-1">Category List</h5>
                </div>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-list me-1"></i>
                    All Categories
                </span>
            </div>
        </div>
        <!-- {{-- Search Section --}} -->
        <div class="px-4 py-3 border-top border-bottom bg-light">
            <form action="/showAllCategory" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="searchCat" id="searchCat" placeholder="Search category name..."
                                class="form-control border-start-0 ps-0">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-search me-1"></i>
                            Search
                        </button>
                    </div>
                    <div class="col-auto">
                        <a href="/showAllCategory" class="btn btn-outline-secondary px-4">
                            <i class="fa-solid fa-rotate-left me-1"></i>
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- {{-- Table Section --}} -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="listStd">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small text-uppercase" style="width: 90px;">
                                Sl. No.
                            </th>
                            <th class="py-3 text-muted small text-uppercase">
                                Category Name
                            </th>
                            <th class="py-3 text-muted small text-uppercase">
                                Creator
                            </th>
                            <th class="py-3 text-muted small text-uppercase text-center" style="width: 200px;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryData as $cat)
                        <tr>
                            <td class="ps-4">
                                <span class="text-muted fw-semibold">{{$categoryData->firstItem() + $loop->index}}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 bg-primary-subtle text-primary
                                        d-flex align-items-center justify-content-center">
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{$cat->category_name}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary">{{$cat->creater}}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-warning rounded-2" title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square me-1"></i>
                                        Edit
                                    </a>
                                    <a href="/viewcatagory/{{Crypt::encrypt($cat->cat_id)}}" class="btn btn-sm btn-outline-info rounded-2" title="View Category">
                                        <i class="fa-solid fa-eye me-1"></i>
                                        View
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- {{-- Footer --}} -->
        <div class="card-footer bg-white border-0 px-4 py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <small class="text-muted">
                    <i class="fa-solid fa-circle-info me-1"></i>
                    Category records
                </small>
            </div>
            <div>
                {{$categoryData->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection