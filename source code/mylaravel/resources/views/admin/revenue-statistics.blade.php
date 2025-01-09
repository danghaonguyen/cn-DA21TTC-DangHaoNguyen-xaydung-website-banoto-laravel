@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-4">
<h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        BIỂU ĐỒ THỐNG KÊ DOANH THU
    </h1>
    <div class="chart-container">
    <canvas id="revenueChart"  
                    data-today="{{ $totalDepositToday }}"
                    data-yesterday="{{ $totalDepositYesterday }}"
                    data-total="{{ $totalDeposit }}"></canvas> <!-- Vị trí để vẽ biểu đồ -->
    </div>
</div>

<script>
        var ctx = document.getElementById('revenueChart').getContext('2d');

        // Lấy giá trị từ data attribute
        var totalDepositToday = document.getElementById('revenueChart').getAttribute('data-today');
        var totalDepositYesterday = document.getElementById('revenueChart').getAttribute('data-yesterday');
        var totalDeposit = document.getElementById('revenueChart').getAttribute('data-total');

        // Chuyển giá trị thành số
        totalDepositToday = parseFloat(totalDepositToday);
        totalDepositYesterday = parseFloat(totalDepositYesterday);
        totalDeposit = parseFloat(totalDeposit);

        console.log(totalDepositToday, totalDepositYesterday, totalDeposit);  // Kiểm tra giá trị

        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Hôm qua', 'Hôm nay', 'Tổng cộng'],  // Tên các nhóm trong biểu đồ
                datasets: [{
                    label: 'Số tiền đặt cọc',
                    data: [totalDepositYesterday, totalDepositToday, totalDeposit],  // Dữ liệu doanh thu
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền của cột
                    borderColor: 'rgba(255, 99, 132, 1)',       // Màu viền của cột
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,  // Đảm bảo bắt đầu từ 0
                        max: totalDeposit + 10000000  // Tăng giới hạn trục Y một chút cho đẹp
                    }
                }
            }
        });
    </script>

<style>
     /* Căn chỉnh vị trí của canvas */
     .chart-container {
            display: flex;
            justify-content: center;  /* Căn giữa biểu đồ */
            align-items: center;      /* Căn giữa theo chiều dọc */
            width: 100%;
            height: 600px;            /* Chiều cao của phần chứa biểu đồ */
            margin: 0 auto;           /* Đảm bảo không có margin ngoài */
        }

        #revenueChart {
            width: 100%;   /* Chiếm 90% chiều rộng của container */
            height: 100%;  /* Chiếm 80% chiều cao của container */
        }
  
</style>

@endsection
