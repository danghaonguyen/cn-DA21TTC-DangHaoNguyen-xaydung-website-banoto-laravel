<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIBECARS - Website Bán Ôtô</title>
</head>
<!-- Bootstrap icons-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<!--Liên kết với CSS -->
<link rel="stylesheet" href="{{ asset('css/boostraps.css') }}">
<link rel="stylesheet" href="{{ asset('css/logo.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/section.css') }}">

<link rel="icon" type="image/x-icon" href="{{ asset('img/vibecars-logo.png') }}" />

<body>
    <!-- Xử lý hộp thoại thông báo lỗi-->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Tạo Form đăng kí -->
    <div class="register-container" style=" background-image: url('img/dark-red.jpg'); background-size: cover; background-position: center;
            background-repeat: no-repeat;">
        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <div class="container-fluid text-center">
                <h2 class="navbar-brand mb-0">VIBECARS</h2>
            </div>

            <!-- Tên người dùng -->
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="name">Tên tài khoản</label>
              
                <input type="text" class="form-control icon-input" id="name" name="name" autocomplete="off" placeholder="VD: Hào Nguyên" required>
            </div>

            <!-- Tên đăng nhập -->
            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <label for="email">Email</label>
             
                <input type="email" class="form-control icon-input" id="email" name="email" autocomplete="off" placeholder="VD: Example@gmail.com" required>
            </div>

            <!-- Mật khẩu -->
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <label for="password">Mật khẩu</label>
 
                <input type="password" class="form-control icon-input" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <label for="password_confirmation">Xác nhận mật khẩu</label>
    
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
            </div>


            <!-- Nút Đăng ký -->
            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>

            <div class="text-center mt-3">
                <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
            </div>
        </form>
    </div>

</body>

</html>