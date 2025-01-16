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
                        Biểu đồ cập nhật doanh thu trong tháng 1
                    </div>
                    <div class="container-fluid px-4">
                        <!-- Thẻ canvas cho biểu đồ -->
                        <div class="chart-container">
                            <canvas id="Chart" width="300" height="300" data-total-deposit="{{ $totalDeposit }}"></canvas>
                        </div>
                    </div>

                    <script>
                        var ctx = document.getElementById('Chart').getContext('2d');

                        // Lấy giá trị của totalDeposit từ thuộc tính data-total-deposit
                        var totalDeposit = document.getElementById('Chart').getAttribute('data-total-deposit');
                        totalDeposit = parseFloat(totalDeposit); // Chuyển đổi thành số nếu cần

                        console.log(totalDeposit); // Kiểm tra giá trị từ data attribute

                        var revenueChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Tổng doanh thu trong tháng 1'],
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

                        #Chart {
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
                        Biểu đồ cập nhật thống kê doanh thu trong năm 2025
                    </div>
                    <!-- Dropdown để chọn tháng -->
                    <div class="form-group mb-4">
                        <label for="chartFilter">Chọn tháng:</label>
                        <select id="chartFilter" class="form-control" onchange="changeChart()">
                            @foreach($months as $month)
                            <option value="{{ $month }}" @if($month==1) selected @endif>
                                Tháng {{ $month }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Container cho biểu đồ -->
                    <div class="chart-container">
                        <canvas id="revenueChart" width="300" height="250"
                            data-months="{{ json_encode($months) }}"
                            data-revenue="{{ json_encode($revenueData) }}"></canvas>
                    </div>
                </div>

                <script>
                    var chart; // Biến global để lưu biểu đồ

                    function changeChart() {
                        var selectedMonth = document.getElementById('chartFilter').value;

                        // Lấy dữ liệu từ data attribute
                        var revenueData = JSON.parse(document.getElementById('revenueChart').getAttribute('data-revenue'));
                        var days = revenueData[selectedMonth].days;
                        var revenues = revenueData[selectedMonth].revenues;


                        var ctx = document.getElementById('revenueChart').getContext('2d');

                        // Xóa biểu đồ cũ (nếu có)
                        if (chart) {
                            chart.destroy();
                        }

                        const colors = [
                            'rgba(255, 99, 132, 0.7)', // Ngày 1 (Màu đỏ)
                            'rgba(54, 162, 235, 0.7)', // Ngày 2 (Màu xanh)
                            'rgba(255, 206, 86, 0.7)', // Ngày 3 (Màu vàng)
                            'rgba(75, 192, 192, 0.7)', // Ngày 4 (Màu xanh lá cây)
                            'rgba(153, 102, 255, 0.7)', // Ngày 5 (Màu tím)
                            'rgba(255, 159, 64, 0.7)', // Ngày 6 (Màu cam)
                            'rgba(230, 100, 255, 0.7)', // Ngày 7 (Màu tím)
                            'rgba(100, 255, 200, 0.7)', // Ngày 8 (Màu xanh dương nhạt)
                            'rgba(200, 200, 255, 0.7)', // Ngày 9 (Màu xanh nhạt)
                            'rgba(255, 69, 0, 0.7)', // Ngày 10 (Màu đỏ cam)
                            'rgba(255, 105, 180, 0.7)', // Ngày 11 (Màu hồng)
                            'rgba(34, 193, 195, 0.7)', // Ngày 12 (Màu xanh biển)
                            'rgba(253, 187, 45, 0.7)', // Ngày 13 (Màu vàng chanh)
                            'rgba(243, 156, 18, 0.7)', // Ngày 14 (Màu vàng đậm)
                            'rgba(244, 67, 54, 0.7)', // Ngày 15 (Màu đỏ tươi)
                            'rgba(60, 179, 113, 0.7)', // Ngày 16 (Màu xanh lá cây đậm)
                            'rgba(255, 165, 0, 0.7)', // Ngày 17 (Màu cam đậm)
                            'rgba(255, 20, 147, 0.7)', // Ngày 18 (Màu hồng đậm)
                            'rgba(139, 0, 0, 0.7)', // Ngày 19 (Màu đỏ tía)
                            'rgba(0, 0, 255, 0.7)', // Ngày 20 (Màu xanh dương)
                            'rgba(255, 140, 0, 0.7)', // Ngày 21 (Màu cam sáng)
                            'rgba(255, 105, 180, 0.7)', // Ngày 22 (Màu hồng nhạt)
                            'rgba(0, 255, 255, 0.7)', // Ngày 23 (Màu xanh lam sáng)
                            'rgba(255, 99, 71, 0.7)', // Ngày 24 (Màu đỏ gạch)
                            'rgba(186, 85, 211, 0.7)', // Ngày 25 (Màu tím nhạt)
                            'rgba(72, 11, 44, 0.7)', // Ngày 26 (Màu nâu đỏ)
                            'rgba(255, 218, 185, 0.7)', // Ngày 27 (Màu vàng nhạt)
                            'rgba(255, 222, 173, 0.7)', // Ngày 28 (Màu vàng kem)
                            'rgba(137, 66, 90, 0.7)', // Ngày 29 (Màu hồng nâu)
                            'rgba(138, 43, 226, 0.7)', // Ngày 30 (Màu tím hoàng gia)
                            'rgba(255, 0, 255, 0.7)' // Ngày 31 (Màu tím sáng)
                        ];


                        // Vẽ lại biểu đồ với dữ liệu mới và màu sắc riêng biệt cho từng ngày
                        chart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: days, // Các ngày trong tháng
                                datasets: [{
                                    label: 'Số tiền đặt cọc',
                                    data: revenues, // Doanh thu cho từng ngày
                                    backgroundColor: colors.slice(0, days.length), // Dùng màu theo từng ngày
                                    borderColor: colors.slice(0, days.length), // Màu viền theo từng ngày
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                scales: {

                                }
                            }
                        });
                    }

                    // Thực hiện mặc định khi load trang
                    window.onload = function() {
                        changeChart();
                    }
                </script>

                <style>
                    .chart-container {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 90%;
                        height: 500px;
                        margin: 0 auto;
                    }

                    #revenueChart {
                        width: 100%;
                        height: 100%;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
</div>

@endsection