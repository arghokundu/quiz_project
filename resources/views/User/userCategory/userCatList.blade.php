@extends('layouts.mainApp')
@section('main_content')
<link rel="stylesheet" href="{{ asset('assets/css/userDashb/cardCat.css') }}">
<div class="container-fluid px-2 py-3">
    <div class="dash-card category-dashboard">
        {{-- Category Section Header --}}
        <div class="category-section-header">
            <div>
                <span class="category-header-label">
                    <i class="fa-solid fa-graduation-cap me-2"></i>
                    LEARNING & ASSESSMENT
                </span>
                <h3 class="category-section-title mt-2">
                    Explore Quiz Categories
                </h3>
                <p class="category-section-subtitle mb-0">
                    Choose your favourite category and test your knowledge.
                </p>
            </div>
            <div class="category-header-icon">
                <i class="fa-solid fa-shapes"></i>
            </div>
        </div>
        {{-- Category Cards --}}
        <div id="quizGridView" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 py-3">
            @forelse($categories as $cat)
            <div class="col quiz-item-card">
                <div class="category-card h-100">
                    {{-- Card Top --}}
                    <div class="category-card-top">
                        <div class="category-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <span class="category-status">
                            <span class="category-status-dot"></span>
                            Available
                        </span>
                    </div>
                    {{-- Card Content --}}
                    <div class="category-card-content">
                        <span class="category-label">
                            QUIZ CATEGORY
                        </span>
                        <h4 class="category-title">
                            {{ $cat->category_name }}
                        </h4>
                        <p class="category-description">
                            Explore exciting questions, improve your knowledge
                            and challenge yourself with this category.
                        </p>
                    </div>
                    {{-- Card Footer --}}
                    <div class="category-card-footer">
                        <a href="#" class="btn-category-primary">
                            <span>
                                <i class="fa-solid fa-compass me-2"></i>
                                Explore Quizzes
                            </span>
                            <i class="fa-solid fa-arrow-right category-arrow"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="category-empty-state">
                    <div class="empty-icon">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h5>No Categories Found</h5>
                    <p>
                        There are no quiz categories available right now.
                        Please check again later.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection