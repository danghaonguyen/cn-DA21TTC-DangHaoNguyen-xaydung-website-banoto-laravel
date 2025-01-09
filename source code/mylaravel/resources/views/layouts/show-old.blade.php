@extends('layouts.app')

@section('content')

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        @if($product->image_color) <!-- Kiểm tra xem $product->image_color có phải là null hay không -->
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                @foreach (json_decode($product->image_color) as $index => $image)
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach (json_decode($product->image_color) as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset($image) }}" alt="Slide {{ $index + 1 }}" class="carousel-image">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        @else
        <p>Chưa có ảnh màu xe</p> <!-- Nếu không có ảnh màu, hiển thị thông báo này -->
        @endif
    </div>
</header>



<style>
    /* CSS cho carousel */
    .carousel-image {
        object-fit: cover;
        display: block;
        margin: 0 auto;
        height: 450px;

    }

    /* Nút Thanh toán và Đăng ký */
    .btn-danger {
        font-size: 18px;
        padding: 12px 24px;
        border-radius: 50px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #d60000;
        transform: translateY(-3px);
        box-shadow: 0px 4px 10px rgba(214, 0, 0, 0.5);
    }

    /* Phần Ngoại thất & Nội thất */
    h2 {
        text-transform: uppercase;
        font-weight: bold;
        color: #333;
    }

    /*  hr {
        margin: 10px auto;
        width: 80px;
        
    } */

    /* Ảnh Ngoại thất & Nội thất */
    #image-container img {
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    #image-container img:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
    }

    /* Section chứa tất cả */
    section {
        background-color: #f9f9f9;
        padding: 30px 0;
    }

    /* Center nội dung trong row */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    /* Mô tả sản phẩm */
    .product-description {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }

    /* Phần giá */
    .product-price {
        font-size: 30px;
        color: #e60000;
        font-weight: bold;
    }

    /* CSS cho ảnh ngoại thất & nội thất */
    .exterior-image,
    .interior-image,
    .specs-image {
        width: 80%;
        /* Giảm kích thước ảnh xuống 80% */
        height: auto;
        margin: 10px auto;
        /* Căn giữa ảnh */
        display: block;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    /* Hiệu ứng hover cho ảnh */
    .exterior-image:hover,
    .interior-image:hover,
    .specs-image:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
    }
</style>

<!-- Section-->
<section class="py-5">
    <h2 class="text-center mb-4"><strong>{{ $product->name }}</strong></h2>
    <hr class="mb-4" style="border-top: 5px solid #333;">

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset($product->image) }}" alt="Xe" class="img-fluid rounded" style="width: auto; height: 325px; object-fit: cover;">
            </div>

            <div class="col-md-4">
                <br>
                <h1 name="price" class="product-price" style="font-style: italic;">GIÁ: {{ number_format($product->price, 0, ',', '.') }}
                    <span style="font-size: 0.6em; color: #e60000; font-weight: bold;">VND</span>
                </h1>
                <h3 style="font-style:italic;"><strong>Hãng xe: {{ $product->brand->name }}</strong></h2>

                    <br>
                    <div class="product-description">{!! $product->description !!}</div>
                    <br>

                    <!-- resources/views/product.blade.php -->
                    @if(auth()->check())
                    <!-- Hiển thị nút thanh toán nếu người dùng đã đăng nhập -->
                    <div class="button-container">

                        <form action="{{ route('payment.create', ['product_id' => $product->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="50000"> <!-- Giá trị thanh toán -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- Truyền user_id -->
                            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}"> <!-- Truyền user_name -->
                            <button type="submit" class="btn btn-danger">ĐẶT CỌC</button>
                        </form>

                        <form action="{{ route('service.test-drive', ['id' => $product->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-danger">ĐĂNG KÝ LÁI THỬ</button>
                        </form>


                        @else
                        <!-- Hiển thị thông báo yêu cầu đăng nhập nếu người dùng chưa đăng nhập -->
                        <p><a href="{{ route('login') }}" class="btn btn-danger" style="color: white;">Vui lòng đăng nhập để thực hiện thanh toán.</a></p>
                        @endif
                    </div>

            </div>
        </div>
    </div>

    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            /* Khoảng cách giữa các nút */
        }

        .button-container a,
        .button-container form {
            flex: 1;
        }

        .button-container a.btn,
        .button-container button {
            width: 100%;
            height: 50px;
            /* Đảm bảo chiều cao của nút */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>


    <div id="image-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h2 style="font-size: 40px; text-align:center"><b>NGOẠI THẤT</b></h2>
                    <hr class="mb-4" style="border-top: 4px solid #333;">

                    @if(is_array($exteriorImages) && count($exteriorImages) > 0)
                    @foreach($exteriorImages as $eximage)
                    <div style="display: flex; justify-content: center;">
                        <img src="{{ asset($eximage) }}" alt="Ảnh ngoạii thất" class="exterior-image">
                    </div>
                    @endforeach
                    @else
                    <p style="text-align:center">Không có ảnh ngoại thất</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h2 style="font-size: 40px; text-align:center"><b>NỘI THẤT</b></h2>
                    <hr class="mb-4" style="border-top: 4px solid #333;">

                    @if(is_array($interiorImages) && count($interiorImages) > 0)
                    @foreach($interiorImages as $inimage)
                    <img src="{{ asset($inimage) }}" alt="Ảnh nội thất" class="interior-image">
                    @endforeach
                    @else
                    <p style="text-align:center">Không có ảnh nội thất</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <h2 style="font-size: 40px; text-align:center"><b>THÔNG SỐ KỸ THUẬT</b></h2>
                    <hr class="mb-4" style="border-top: 4px solid #333;">

                    @if(is_array($specsImages) && count($specsImages) > 0)
                    @foreach($specsImages as $specsimage)
                    <img src="{{ asset($specsimage) }}" alt="Ảnh nội thất" class="specs-image">
                    @endforeach
                    @else
                    <p style="text-align:center">Không có ảnh thông số kỹ thuật</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('image-container');
        const viewer = new Viewer(container, {
            inline: false,
            navbar: false,
            toolbar: true,
        });
    });
</script>

@endsection