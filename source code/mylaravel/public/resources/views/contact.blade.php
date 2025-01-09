@extends('layouts.app')

@section('content')
<header>
</header>
<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">LIÊN HỆ</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="cost-estimation">
        <div class="form-container">

            <!-- Form 1 -->
            <div class="form-right">

                <h2 class="text-center mb-4" style="font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">VIBECARS</h2>
                <hr>
                <h3><i class="fas fa-map-marker-alt"></i> <strong>ĐỊA CHỈ</strong></h3>
                <h5>Số 1, Đường Nguyễn Đáng, Phường 7, Thành phố Trà Vinh</h5>
                <h5>Số 2, Đường Hùng Vương, Phường 5, Thành phố Trà Vinh</h5>
                <h5>Số 10, Đường Lý Thường Kiệt, Phường 3, Thành phố Trà Vinh</h5>
                <hr>
                <h3><i class="fas fa-phone"></i> <strong>HOTLINE</strong></h3>
                <h5>0917 702 292</h5>
                <hr>
                <h3><i class="fas fa-envelope"></i> <strong>EMAIL</strong></h3>
                <h5>haonguyen@outlook.com</h5>
                <p><strong>Liên hệ ngay để được tư vấn hỗ trợ thêm</strong></p>
            </div>

            <!-- Form 2 -->
            <div class="form-custom">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập Họ Tên" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập Số Điện Thoại" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập Email" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="car-interest">Xe Bạn Quan Tâm</label>
                    <input type="text" class="form-control" id="car-interest" placeholder="Nhập Xe Bạn Quan Tâm" autocomplete="off">
                </div>

                <button type="submit" class="btn-custom">Đăng Ký</button>
            </div>

        </div>
    </div>
</div>

@endsection