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
        border-radius: 10px;
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
                <img src="{{ asset($product->image) }}" alt="Xe" class="img-fluid rounded" style="width: auto; height: 300px; object-fit: cover;">
            </div>

            <div class="col-md-4">
                <br>
                <h1 name="price" class="product-price" style="font-style: italic;">GIÁ: {{ number_format($product->price, 0, ',', '.') }}
                    <span style="font-size: 0.6em; color: #e60000; font-weight: bold;">VND</span>
                </h1>
                <h3 style="font-style:italic;"><strong>Hãng xe: {{ $product->brand->name }}</strong></h2>

    
       <!--              <div class="product-description">{!! $product->description !!}</div> -->


                    <!-- resources/views/product.blade.php -->
                    @if(auth()->check())
                    <!-- Hiển thị nút thanh toán nếu người dùng đã đăng nhập -->
                    <div class="button-container">
                        <!--         <form>
                          <button type="submit" class="btn btn-danger">ĐẶT CỌC</button>
                        </form> -->
                    </div>
                    <div class="button-container">
                        <form action="{{ route('payment.create', ['product_id' => $product->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" value="50000"> <!-- Giá trị thanh toán -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- Truyền user_id -->
                            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}"> <!-- Truyền user_name -->
                            <button type="submit" class="btn btn-danger" style="font-weight:bold;">
                                <i class="fab fa-cricle"> </i> ĐẶT CỌC QUA ZALOPAY</button>
                        </form>
                    </div>

                    <div class="button-container">
                    <form action="{{ route('momo-payment', ['product_id' => $product->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="payUrl" value="{{ session('payUrl') }}" />
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- Truyền user_id -->
                            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}"> <!-- Truyền user_name -->
                            <button type="submit" class="btn btn-danger" style="font-weight:bold;">ĐẶT CỌC QUA MOMO</button>
                        </form>
                    </div>

                    <div class="button-container">
                        <form action="{{ route('service.test-drive', ['id' => $product->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="font-weight:bold;">ĐĂNG KÝ LÁI THỬ</button>
                        </form>
                    </div>
                    <p style="font-style: italic; color:red"> Lưu ý: Đặt cọc bằng 10% số tiền / tổng giá trị của xe</p>
                    @else
                    <!-- Hiển thị thông báo yêu cầu đăng nhập nếu người dùng chưa đăng nhập -->
                    <p><a href="{{ route('login') }}" class="btn btn-danger" style="color: white; margin-top:15px; width:70%">
                    Vui lòng đăng nhập nếu bạn muốn thanh toán.</a></p>
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
            margin-bottom: 10px;

            /* Khoảng cách giữa các nút */
        }

        .button-container a,
        .button-container form {
            flex: 1;
        }

        .button-container a.btn,
        .button-container button {
            width: 70%;
            height: 40px;
            /* Đảm bảo chiều cao của nút */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 5px;
        }

        /* Tab navigation styles */
        .nav-tabs .nav-link {
            font-weight: bold;
            text-transform: uppercase;
            background-color: transparent;
            border: 2px solid #ddd;
            padding: 10px 20px;
            margin: 5px;

            color: #555;
            /* Màu chữ khi chưa chọn */
            background-color: #f1f1f1;
            /* Màu nền khi chưa chọn */
            border: 1px solid #ddd;
            /* Biên giới của tab */
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background-color: #e60000;
            color: white;
            border-color: #e60000;

        }

        /* Đảm bảo các hình ảnh trong các tab được hiển thị theo ngang */
        .exterior-image,
        .interior-image,
        .specs-image {
            display: inline-block;
            /* Sử dụng inline-block để hình ảnh xếp ngang */
            width: 32.3%;
            /* Điều chỉnh kích thước của hình ảnh (có thể thay đổi theo ý muốn) */
            height: auto;
            margin-right: 10px;
            /* Khoảng cách giữa các hình ảnh */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .exterior-image:hover,
        .interior-image:hover,
        .specs-image:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.4);
        }

        /* Đảm bảo các hình ảnh trong tab sẽ căn chỉnh đều */
        .tab-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>

    <div class="service">
        <!-- Tab Navigation -->
        <div id="image-container">
            <div class="container py-5">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="exterior-tab" data-bs-toggle="tab" href="#exterior" role="tab" aria-controls="exterior" aria-selected="true">Ngoại Thất</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="interior-tab" data-bs-toggle="tab" href="#interior" role="tab" aria-controls="interior" aria-selected="false">Nội Thất</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="specs-tab" data-bs-toggle="tab" href="#specs" role="tab" aria-controls="specs" aria-selected="false">Thông Số Kỹ Thuật</a>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane fade show active" id="exterior" role="tabpanel" aria-labelledby="exterior-tab">
                        @if(is_array($exteriorImages) && count($exteriorImages) > 0)
                        @foreach($exteriorImages as $eximage)
                        <img src="{{ asset($eximage) }}" alt="Ngoại thất" class="exterior-image">
                        @endforeach
                        @else
                        <p style="text-align: center; margin-top:200px; margin-bottom:200px">Không có ảnh ngoại thất</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="interior" role="tabpanel" aria-labelledby="interior-tab">
                        @if(is_array($interiorImages) && count($interiorImages) > 0)
                        @foreach($interiorImages as $inimage)
                        <img src="{{ asset($inimage) }}" alt="Nội thất" class="interior-image">
                        @endforeach
                        @else
                        <p style="text-align: center; margin-top:200px; margin-bottom:200px">Không có ảnh nội thất</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                        @if(is_array($specsImages) && count($specsImages) > 0)
                        @foreach($specsImages as $specsimage)
                        <img src="{{ asset($specsimage) }}" alt="Thông số kỹ thuật" class="specs-image" style="width: 100%;">
                        @endforeach
                        @else
                        <p style="text-align: center; margin-top:200px; margin-bottom:200px">Không có ảnh thông số kỹ thuật</p>
                        @endif
                    </div>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Khi click vào một tab
        const tabs = document.querySelectorAll('.nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Loại bỏ class 'active' khỏi tất cả các tab
                tabs.forEach(t => t.classList.remove('active'));

                // Thêm 'active' vào tab đã click
                this.classList.add('active');

                // Lấy id của tab vừa click
                const targetTab = this.getAttribute('href').substring(1);

                // Ẩn tất cả các tab content
                const tabContents = document.querySelectorAll('.tab-pane');
                tabContents.forEach(content => content.classList.remove('active'));

                // Hiển thị tab content tương ứng với tab đã click
                document.getElementById(targetTab).classList.add('active');
            });
        });
    });
</script>

@endsection