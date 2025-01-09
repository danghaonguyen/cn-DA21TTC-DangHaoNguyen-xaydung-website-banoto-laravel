@extends('layouts.app')

@section('content')

<!-- @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif -->
<!-- Xử lý sildeshow -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>


            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/silde/silde1.jpg" class="d-block w-100" alt="Slide 1" height="600px">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-4 fw-bolder">TOYOTA</h1>
                        <p class="lead fw-normal"><b>"Cùng nhau khám phá những nơi mới"</b></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/silde/silde3.jpg" class="d-block w-100" alt="Slide 3" height="600px">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-4 fw-bolder">HONDA</h1>
                        <p class="lead fw-normal"><b>"Sức mạnh của những giấc mơ"</b></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/silde/silde4.jpg" class="d-block w-100" alt="Slide 4" height="600px">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-4 fw-bolder">HYUNDAI</h1>
                        <p class="lead fw-normal"><b>"Suy nghĩ mới. Khả năng mới."</b></p>
                    </div>
                </div>

            </div>
            <!--
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
-->
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <h2 class="text-center mb-4">CÁC SẢN PHẨM NỔI BẬT</h2>
    <hr class="mb-4" style="border-top: 4px solid #333;">
    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->

                    <a href="{{ route('layouts.show', $product->id) }}">
                        <img class="card-img-top" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    </a>

                    <!-- Modal for each product -->
                    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product details-->
                    <div class="tooltip">
                        <strong>{{ $product->name }}</strong><br>
                        {!! $product->description !!} <!-- Hiển thông tin về xe -->
                    </div>

                    <div class="card-body p-3">
                        <div class="text-start">
                            <!-- Product name-->
                            <h4 class="fw-bolder" style="text-align: left;">{{ $product->name }}</h4>
                            <p>Giá từ {{ number_format($product->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <h2 class="text-center mb-4">BÀI VIẾT NỔI BẬT</h2>
    <hr class="mb-4" style="border-top: 4px solid #333;">
    <div class="container px-4 px-lg-5 mt-5">
    <div class="article">
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
        <style>
    .article .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .article .card-img-top {
        transition: transform 0.3s ease;
    }

    .article.card:hover .card-img-top {
        transform: scale(1.1);
    }

    .article.card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .article .card-category {
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .article .card-text {
        margin-bottom: 10px;
    }
</style>
</section>
@endsection