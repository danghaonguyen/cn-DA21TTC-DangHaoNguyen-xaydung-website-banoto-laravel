@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        BIỂU ĐỒ THỐNG KÊ DOANH THU
    </h1>

    <!-- Dropdown để chọn tháng -->
    <div class="form-group mb-4">
        <label for="chartFilter">Chọn tháng:</label>
        <select id="chartFilter" class="form-control" onchange="changeChart()">
            @foreach($months as $month)
                <option value="{{ $month }}" @if($month == 1) selected @endif>
                    Tháng {{ $month }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Container cho biểu đồ -->
    <div class="chart-container">
        <canvas id="revenueChart"  
                data-months="{{ json_encode($months) }}"
                data-revenue="{{ json_encode($revenueData) }}"></canvas>
    </div>
</div>

<script>
    var chart;  // Biến global để lưu biểu đồ

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

        // Vẽ lại biểu đồ với dữ liệu mới
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,  // Các ngày trong tháng
                datasets: [{
                    label: 'Số tiền đặt cọc',
                    data: revenues,  // Doanh thu cho từng ngày
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
                    }
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
        width: 100%;
        height: 600px;           
        margin: 0 auto;           
    }

    #revenueChart {
        width: 100%;   
        height: 100%;  
    }
</style>

@endsection
