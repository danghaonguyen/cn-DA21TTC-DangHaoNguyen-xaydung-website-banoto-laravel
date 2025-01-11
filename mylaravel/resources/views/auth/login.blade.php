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

   <link rel="stylesheet" href="{{ asset('css/login.css') }}">
   <link rel="stylesheet" href="{{ asset('css/section.css') }}">

   <link rel="icon" type="image/x-icon" href="{{ asset('img/vibecars-logo.png') }}" />


   <!-- Tạo form đăng nhập -->
   <div class="login-container" style=" background-image: url('img/dark-red.jpg'); background-size: cover; background-position: center;
            background-repeat: no-repeat;">
       <form method="POST" action="{{ route('login') }}" class="login-form">
           @csrf

           <div class="container-fluid text-center">
               <h2 class="navbar-brand mb-0">VIBECARS</h2>
           </div>


           <div class="form-group">
            <i class="fa fa-envelope"></i>
               <label for="email">Email</label>
             
               <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="Nhập email của bạn">
           </div>
           <div class="form-group">
            <i class="fas fa-lock"></i>
               <label for="password">Mật khẩu</label>
     
               <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
           </div>
           <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>

           <div class="text-center mt-3">
               <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
           </div>
       </form>
   </div>