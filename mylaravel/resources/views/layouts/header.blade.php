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

                    <!-- Biểu tượng tìm kiếm -->
                    <button id="search-icon" class="search-btn">
                        <i class="fas fa-search" style="font-size: 16px"></i>
                    </button>

                    <!-- Form tìm kiếm, ban đầu ẩn đi -->
                    <div id="search-form" class="search-form" style="display: none;">
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa bạn muốn tìm..." value="{{ old('keyword') }}" autocomplete="off">
                           <!--  <button type="submit" class="btn btn-danger">Tìm kiếm</button> -->
                        </form>
                    </div>

                    <style>
                       

                        /* CSS cho form tìm kiếm */
                        .search-form {
                            position: absolute;
                            top: 70px;
                            /* Vị trí dưới biểu tượng tìm kiếm */

                            right: 200px;
                            padding: 10px;
                            background-color: #fff;
                            border-radius: 8px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            display: none;
                            width: 300px;
                            margin: 0 auto;
                        }

                        .search-form input {
                            width: 100%;
                            padding: 8px;
                    
                            border: 1px solid #ccc;
                            border-radius: 5px;
                        }

                        .search-form button {
                            width: 100%;
                            padding: 8px;
                            background-color: #e60000;
                            border: none;
                            color: white;
                            font-size: 16px;
                            border-radius: 5px;
                            cursor: pointer;
                        }

                        .search-form button:hover {
                            background-color: #e60000;
                        }
                    </style>

                    <script>
                        // Lắng nghe sự kiện click trên biểu tượng tìm kiếm
                        document.getElementById('search-icon').addEventListener('click', function() {
                            // Hiển thị hoặc ẩn form tìm kiếm khi click vào biểu tượng tìm kiếm
                            var searchForm = document.getElementById('search-form');
                            if (searchForm.style.display === 'none') {
                                searchForm.style.display = 'block'; // Hiển thị form tìm kiếm
                            } else {
                                searchForm.style.display = 'none'; // Ẩn form tìm kiếm
                            }
                        });

                        // Lắng nghe sự kiện khi nhấn phím Enter trong form tìm kiếm
                        document.querySelector('input[name="keyword"]').addEventListener('keypress', function(event) {
                            if (event.key === 'Enter') {
                                // Khi nhấn Enter, gửi form để chuyển hướng đến trang kết quả tìm kiếm
                                event.preventDefault(); // Ngừng hành động mặc định (ngừng reload trang)
                                this.closest('form').submit(); // Gửi form tìm kiếm
                            }
                        });
                    </script>

                </ul>

                <form class="d-flex">
                    @if(auth()->check())
                    <!-- Hiển thị nút đăng xuất và profile khi người dùng đã đăng nhập -->
                    <a href="{{ route('profile') }}" class="btn btn-outline-dark me-2">
                        <i class="fas fa-user"></i> {{ auth()->user()->name }}
                    </a>
                    <!--  <button class="btn btn-outline-dark" type="submit">
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