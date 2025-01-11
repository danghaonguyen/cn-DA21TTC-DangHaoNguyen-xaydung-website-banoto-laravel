@extends('admin.dashboard')

@section('content')

<div class="container-fluid px">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        Xin chào ! {{ auth()->user()->name }} </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Trang chủ</li>
    </ol>

    <div class="row">
        <!-- <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><strong>QUẢN LÝ SẢN PHẨM</strong></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <a style="text-decoration: none;"
                                class="small text-white" href="{{ route('admin.manager-product') }}">Xem chi tiết</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><strong>QUẢN LÝ BÀI VIẾT</strong></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <a style="text-decoration: none;"
                                class="small text-white" href="#">Xem chi tiết</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div> -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color:rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>DANH SÁCH SẢN PHẨM</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.list-product') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>DANH SÁCH BÀI VIẾT</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.list-article') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>DANH SÁCH ĐƠN HÀNG </strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.list-orders') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>DANH SÁCH ĐĂNG KÝ TRẢ GÓP</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.list-installment') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>DANH SÁCH ĐĂNG KÝ LÁI THỬ</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.list-testdrive') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white mb-4" style="background-color: rgb(253, 53, 53); color: white;" mb-4>
                <div class="card-body"><strong>THỐNG KÊ DOANH THU</strong></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a style="text-decoration: none;" class="small text-white" href="{{ route('admin.revenue-statistics') }}">Xem chi tiết</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Biểu đồ cập nhật tổng doanh thu theo ngày
                    </div>
                    <div class="container-fluid px-4">
                        <!-- Thẻ canvas cho biểu đồ -->
                        <div class="chart-container">
                            <canvas id="revenueChart" width="400" height="300" data-total-deposit="{{ $totalDeposit }}"></canvas>
                        </div>
                    </div>

                    <script>
                        var ctx = document.getElementById('revenueChart').getContext('2d');

                        // Lấy giá trị của totalDeposit từ thuộc tính data-total-deposit
                        var totalDeposit = document.getElementById('revenueChart').getAttribute('data-total-deposit');
                        totalDeposit = parseFloat(totalDeposit); // Chuyển đổi thành số nếu cần

                        console.log(totalDeposit); // Kiểm tra giá trị từ data attribute

                        var revenueChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Tổng cộng'],
                                datasets: [{
                                    label: 'Số tiền đặt cọc',
                                    data: [totalDeposit], // Truyền giá trị vào data
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền của cột
                                    borderColor: 'rgba(255, 99, 132, 1)', // Màu viền của cột
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        min: 0, // Đảm bảo bắt đầu từ 0
                                        //max: totalDeposit + 10000000  // Tăng giới hạn trục Y một chút cho đẹp
                                    }
                                }
                            }
                        });
                    </script>

                    <style>
                        /* Căn chỉnh vị trí của canvas */
                        .chart-container {
                            display: flex;
                            justify-content: center;
                            /* Căn giữa biểu đồ */
                            align-items: center;
                            /* Căn giữa theo chiều dọc */
                            width: 100%;
                            height: 400px;
                            /* Chiều cao của phần chứa biểu đồ */
                            margin: 0 auto;
                            /* Đảm bảo không có margin ngoài */
                        }

                        #revenueChart {
                            width: 50%;
                            /* Chiếm 90% chiều rộng của container */
                            height: 50%;
                            /* Chiếm 80% chiều cao của container */
                        }
                    </style>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Biểu đồ cập nhật thống kê doanh thu qua từng ngày
                    </div>
                    <div class="container-fluid px-4">
                        <!-- Thẻ canvas cho biểu đồ -->
                        <div class="chart-container">
                            <canvas id="myLineChart" width="400" height="300"  
                            data-today="{{ $totalDepositToday }}"
                            data-yesterday="{{ $totalDepositYesterday }}">
                        </canvas>
                        </div>
                    </div>

                    <script>
                        var ctx = document.getElementById('myLineChart').getContext('2d');

                        // Lấy giá trị của totalDeposit từ thuộc tính data-total-deposit
                        var totalDepositToday = document.getElementById('myLineChart').getAttribute('data-today');
                        var totalDepositYesterday = document.getElementById('myLineChart').getAttribute('data-yesterday');

                        totalDepositToday  = parseFloat(totalDepositToday ); // Chuyển đổi thành số nếu cần
                        totalDepositYesterday  = parseFloat(totalDepositYesterday);

                        console.log(totalDepositToday, totalDepositYesterday ); // Kiểm tra giá trị từ data attribute

                        var revenueChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Hôm qua', 'Hôm nay'],
                                datasets: [{
                                    label: 'Doanh thu',
                                    data: [totalDepositYesterday, totalDepositToday], // Truyền giá trị vào data
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền của cột
                                    borderColor: 'rgba(255, 99, 132, 1)', // Màu viền của cột
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        min: 0, // Đảm bảo bắt đầu từ 0
                                        //max: totalDeposit + 10000000  // Tăng giới hạn trục Y một chút cho đẹp
                                    }
                                } 
                            }
                        });
                    </script>

                    <style>
                        /* Căn chỉnh vị trí của canvas */
                        .chart-container {
                            display: flex;
                            justify-content: center;
                            /* Căn giữa biểu đồ */
                            align-items: center;
                            /* Căn giữa theo chiều dọc */
                            width: 100%;
                            height: 400px;
                            /* Chiều cao của phần chứa biểu đồ */
                            margin: 0 auto;
                            /* Đảm bảo không có margin ngoài */
                        }

                        #myLineChart{
                            width: 50%;
                            /* Chiếm 90% chiều rộng của container */
                            height: 50%;
                            /* Chiếm 80% chiều cao của container */
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection