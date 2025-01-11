@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">KHUYẾN MÃI</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="service">
    <div class="row">
        <!-- Thông báo về các sự kiện khuyến mãi chưa có -->
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body" style="align-items: center; margin-top:250px;">
                    <h5 class="card-title" style="font-size: 24px; font-weight: bold;">Hiện tại chưa có các sự kiện khuyến mãi</h5>
                    <p class="card-text" style="font-size: 18px;">Chúng tôi sẽ cập nhật các chương trình khuyến mãi và sự kiện mới sớm nhất. Hãy quay lại thường xuyên để không bỏ lỡ các cơ hội đặc biệt.</p>
                    <a href="{{ route('home') }}" class="btn btn-secondary" style="font-size: 14px;">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
