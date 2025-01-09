@extends('layouts.app')

@section('content')
<!-- Header-->
<header>
    <div class="header-image">
        <img src="{{ asset('img/banner/banner-hyundai.png') }}" alt="Hình ảnh tiêu đề" class="img-fluid">
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <h2 class="text-center mb-4">CÁC DÒNG XE HYUNDAI</h2>
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
</section>

@endsection