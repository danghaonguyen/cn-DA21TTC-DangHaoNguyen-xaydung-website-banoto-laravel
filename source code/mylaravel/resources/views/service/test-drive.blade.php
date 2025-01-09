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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập Họ Tên" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập Số Điện Thoại" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email" required>
                </div>

                <div class="form-group">
                    <label for="car-interest">Xe Bạn Quan Tâm</label>
                    <input type="text" class="form-control" id="car-interest" name="car_interest" placeholder="Nhập Xe Bạn Quan Tâm" required>
                </div>
                
                <button type="submit" class="btn-custom">Đăng Ký</button>
                <br>
                <br>
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
