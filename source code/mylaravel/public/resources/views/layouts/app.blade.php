    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Liên kết logo hình ảnh cho phần tiêu đề-->
        <link rel="icon" type="image/x-icon" href="{{ asset('img/vibecars-logo.png') }}" />

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Liên kết với CSS -->
        <link rel="stylesheet" href="{{ asset('css/boostraps.css') }}">
        <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">
        <link rel="stylesheet" href="{{ asset('css/section.css') }}">
        <link rel="stylesheet" href="{{ asset('css/service.css') }}">


        <!-- Viewer CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.css" rel="stylesheet">

        <!-- Viewer JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.3/viewer.min.js"></script>

        <title>VIBECARS - Website Bán Ôtô</title>
    </head>

    <body>
        @include('layouts.header') <!-- Nhúng header -->

        @yield('content') <!-- Nội dung của trang con sẽ được chèn ở đây -->

        @include('layouts.footer') <!-- Nhúng footer -->
    </body>

    </html>