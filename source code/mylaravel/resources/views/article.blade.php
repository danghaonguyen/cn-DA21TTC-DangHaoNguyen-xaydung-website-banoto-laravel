@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4">BÀI VIẾT</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="service">
        <div class="row">
            <!-- Loop through the articles -->
            @foreach ($articles as $article)
            <div class="col-md-4">
                <div class="card shadow-sm border-light rounded">
                    <!-- Image with aspect ratio -->
                    <a href="{{ route('article-details', $article->id) }}">
                        <img src="{{ $article->image }}" alt="{{ $article->title }}" style="object-fit: cover; width: 100%; height: 220px;">
                    </a>
                    <div class="card-body">
                        <!-- Title -->
                        <h5 class="card-title text-dark" style="font-size: 1.25rem; font-weight: 700; line-height: 1.4;">
                            {{ $article->title }}
                        </h5>
                        <!-- Author and date -->
                        <p class="card-text text-muted" style="font-size: 0.9rem;">
                            {{ $article->author }} -
                            <span>{{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</span>
                        </p>

                        <!-- Read more button -->
                        <!-- <div class="d-flex justify-content-start">
                <a href="{{ route('article-details', $article->id) }}" class="btn btn-danger">Đọc thêm</a>
            </div> -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.1);
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .card-category {
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .card-text {
        margin-bottom: 10px;
    }
</style>
@endsection