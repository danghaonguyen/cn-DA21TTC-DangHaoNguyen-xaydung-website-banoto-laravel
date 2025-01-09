    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-car"></i>VIBECARS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><b>TRANG CHỦ</b></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>SẢN PHẨM</b></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item" href="{{ route('products.toyota') }}">Toyota</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.honda') }}">Honda</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.hyundai') }}">Hyundai</a></li>


                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>DỊCH VỤ</b></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('service.warranty') }}">Bảo Hành</a></li>
                            <li><a class="dropdown-item" href="{{ route('service.accessories') }}">Phụ Tùng Và Phụ Kiện</a></li>
                            <li><a class="dropdown-item" href="{{ route('service.test-drive') }}">Đăng Ký Lái Thử</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>MUA XE</b></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('service.installment') }}">Trả Góp</a></li>
                            <li><a class="dropdown-item" href="{{ route('service.cost-estimation') }}">Dự Toán Chi Phí</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('sales') }}"><b>KHUYẾN MÃI</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('article') }}"><b>BÀI VIẾT</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}"><b>LIÊN HỆ</b></a></li>
                    <!--
                    <button id="search-icon">
                        <i class="fas fa-search"></i>  FontAwesome icon for search
                    </button>
                    -->
                </ul>

                <form class="d-flex">
                    @if(auth()->check())
                    <!-- Hiển thị nút đăng xuất và profile khi người dùng đã đăng nhập -->
                    <a href="{{ route('profile') }}" class="btn btn-outline-dark me-2">
                        <i class="fas fa-user"></i> {{ auth()->user()->name }}
                    </a>
                    <!-- <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button> -->
                    <a href="{{ route('logout') }}" class="btn btn-outline-dark me-2">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    @else
                    <!-- Hiển thị nút đăng nhập và đăng ký khi người dùng chưa đăng nhập -->
                    <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">
                        <i class="fas fa-user"></i> Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark me-2">
                        <i class="fas fa-user-plus"></i> Đăng ký
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </nav>