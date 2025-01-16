@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4">ĐĂNG KÝ LÁI THỬ</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="test-drive">
        <div class="form-custom">
            <form action="{{ route('service.test-drive') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập Họ Tên" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập Số Điện Thoại" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email" required autocomplete="off">
                </div>

                <div class="form-group">
                        <label for="product_id">Xe bạn quan tâm:</label>
                        <select class="form-control" name="product_id" id="product_id" required style="appearance: auto;">
                            <!-- Giả sử bạn đã có danh sách sản phẩm -->
                            <option value="">-- Chọn xe --</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                <button type="submit" class="btn-custom">Đăng Ký</button>
                <br>
                <br>
                <p style="color: red;">Khi khách hàng đăng ký, chúng tôi sẽ gửi thông tin về thời gian, địa điểm cụ thể cho khách hàng qua gmail.
                Hãy check gmail nhé!. </p>
          
                <!-- Thông báo khi active button đăng ký -->
                @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
                @endif
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif


            </form>
        </div>
    </div>
</div>

@endsection
