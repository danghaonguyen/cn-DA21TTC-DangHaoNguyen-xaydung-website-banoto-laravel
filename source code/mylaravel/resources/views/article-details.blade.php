@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">

    <div class="d-flex justify-content-end">
        <a href="{{ route('home') }}" class="btn btn-secondary mt-4" style="background-color:#e60000;">
            <i class="fa fa-home"></i>
        </a>
        <a href="{{ route('article') }}" class="btn btn-secondary mt-4" style="background-color:#e60000;">
            Bài viết
        </a>
    </div>
    <hr>
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item active" style="font-weight: bold;">{{ $article->title }}</li>
    </ol>
    <div class="service">
        <!-- Article Content -->

        <div class="row">
            <!-- Left column for article image -->
            <!-- <div class="col-md-4">
                <img src="{{ asset($article->image) }}" class="card-img-top">
            </div> -->
            <div class="article-content mt-4">
                {!! $article->content !!}
            </div>

            <!-- Right column for article text -->
            <div class="article-content mt-4" style="line-height: 2.0; font-style: italic; text-align: right;">

                <p><strong>{{ $article->author }}
                        - {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</strong></p>

            </div>
        </div>
        <div class="comment-section">
            <h3>Bình luận</h3>

            <!-- Form nhập bình luận -->
            <form action="{{ route('comments.store', $article->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" placeholder="Chia sẻ bình luận của bạn" rows="1"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger">Gửi bình luận</button>
                </div>
            </form>

            <h3>Các bình luận</h3>
            <!-- Hiển thị các bình luận -->
            @foreach($article->comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name }}</strong> {{ $comment->content }}</p>
                <p style="font-size: 0.9rem; text-align:right;">{{ $comment->created_at->format('d/m/Y') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .article-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .article-content {
        padding-left: 20px;
        padding-right: 20px;
        text-align: justify;
        line-height: 1.8;
    }

    .comment-section {
        margin-top: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .comment-section h3 {
        margin-bottom: 15px;
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    .comment-section .form-group {
        margin-bottom: 15px;
    }

    .comment-section textarea.form-control {
        resize: none;
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
    }

    .comment-section .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
    }

    .comment-section .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .comment-section .comment {
        background-color: #fff;
        padding: 15px;
        padding-top: 2px;
        padding-bottom: 5px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .comment-section .comment p {
        margin: 5px 0;
    }

    .comment-section .comment strong {
        font-size: 1.1rem;
        color: #333;
    }

    .comment-section .comment .date {
        font-size: 0.9rem;
        color: #777;
    }
   


    
</style>



@endsection