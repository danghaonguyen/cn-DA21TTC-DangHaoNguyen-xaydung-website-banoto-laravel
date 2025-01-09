<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laravel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/laravel-icon.jpg') }}" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
        <!-- Navbar Brand-->
        <h4 style="font-family:'Nunito', sans-serif; font-weight: bold;">    

            <a style="color:rgb(255, 255, 255); font-size: 23px;" class="navbar-brand ps-3" href="{{ route('admin.home-dashboard') }}">
                <b><i class="fab fa-laravel" style="font-size: 25px; color: white;"></i> Laravel</b></a>

        </h4>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bars" style="font-size:20px"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!"><i class="fa fa-user-circle"></i> Hồ sơ</a></li>
                    <li><a class="dropdown-item" href="#!"><i class="fa fa-wrench"></i> Cài đặt</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <style>
        /* Đảm bảo sidebar có chiều rộng cố định */
        #layoutSidenav_nav {
            width: 250px;
            /* Hoặc giá trị bạn muốn */
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
        }

        /* Phần nội dung chính */
        #layoutSidenav_content {
            margin-left: 250px;
            /* Đảm bảo phần nội dung không bị chồng lên sidebar */
            padding: 20px;
            width: calc(100% - 250px);
            /* Giới hạn chiều rộng của nội dung chính */
        }

        /* Đảm bảo nội dung không bị lệch khi thu nhỏ màn hình */
        @media (max-width: 768px) {
            #layoutSidenav_content {
                margin-left: 0;
                width: 100%;
            }

            #layoutSidenav_nav {
                width: 100%;
                position: relative;
            }
        }

        .navbar-nav {
            margin-left: auto;
            /* Đẩy tất cả các phần tử navbar về phía bên phải */
        }

        .navbar-nav .nav-item {
            display: flex;
            justify-content: flex-end;
            /* Căn chỉnh mục dropdown vào bên phải */
        }
    </style>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!-- Option Menu -->
                        <div class="sb-sidenav-menu-heading">LARAVEL MENU</div>

                        <!-- Quản lý - Dropdown -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseManagement" aria-expanded="false" aria-controls="collapseManagement">
                            <div class="sb-nav-link-icon"><i class="fa fa-cogs"></i></div>
                            <b>QUẢN LÝ</b>
                        </a>
                        <div class="collapse" id="collapseManagement">
                            <a class="nav-link" href="{{ route('admin.manager-product') }}"><b>SẢN PHẨM</b></a>
                            <a class="nav-link" href="{{ route('admin.manager-article') }}"><b>BÀI VIẾT</b></a>
                        </div>

                        <!-- Danh sách - Dropdown -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseList" aria-expanded="false" aria-controls="collapseList">
                            <div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>
                            <b>DANH SÁCH</b>
                        </a>
                        <div class="collapse" id="collapseList">
                            <a class="nav-link" href="{{ route('admin.list-product') }}"><b>D/S SẢN PHẨM</b></a>
                            <a class="nav-link" href="{{ route('admin.list-orders') }}"><b>D/S ĐƠN HÀNG</b></a>
                            <a class="nav-link" href="{{ route('admin.list-article') }}"><b>D/S BÀI VIẾT</b></a>
                            <a class="nav-link" href="{{ route('admin.list-installment') }}"><b>D/S ĐĂNG KÝ MUA XE TRẢ GÓP</b></a>
                            <a class="nav-link" href="{{ route('admin.list-testdrive') }}"><b>D/S ĐĂNG KÝ LÁI THỬ</b></a>
                        </div>

                        <!-- Thống kê - Dropdown -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStats" aria-expanded="false" aria-controls="collapseStats">
                            <div class="sb-nav-link-icon"><i class="fa fa-chart-line"></i></div>
                            <b>THỐNG KÊ</b>
                        </a>
                        <div class="collapse" id="collapseStats">
                            <a class="nav-link" href="{{ route('admin.revenue-statistics') }}"><b>THỐNG KÊ DOANH THU</b></a>
                        </div>

                        <!-- Logout -->
                        <!-- <div class="sb-sidenav-menu-heading">LOGOUT</div>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                            <b>ĐĂNG XUẤT</b>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>  -->
                    </div>
                </div>


                <!-- Footer sidebar -->
                <div class="sb-sidenav-footer">
                    <div class="small">Đăng nhập bởi:</div>
                    {{ auth()->user()->name }}
                </div>
            </nav>
        </div>
    </div>



    <div id="layoutSidenav_content">
        <main>
            @yield('content')
            <!-- Thêm biểu đồ thống kê doanh thu -->
             
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Laravel Admin &copy; 2025</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>