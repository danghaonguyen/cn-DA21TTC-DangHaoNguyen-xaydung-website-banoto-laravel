<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Order;
use Carbon\Carbon;

class RevenueController extends Controller // Thống kê quản lý doanh thu
{
    /* public function showRevenueChart()
    {
        // Lấy tổng tiền đặt cọc
        $today = Carbon::today();  // Ngày hiện tại
        $totalDepositToday = Order::whereDate('created_at', $today)->sum('deposit_amount');  // Tính tổng doanh thu hôm nay từ cột `total_price`

        // Lấy doanh thu hôm qua
        $yesterday = Carbon::yesterday();  // Ngày hôm qua
        $totalDepositYesterday = Order::whereDate('created_at', $yesterday)->sum('deposit_amount');  // Doanh thu hôm qua

        // Lấy tổng doanh thu
        $totalDeposit = Order::sum('deposit_amount'); 

        
        // Tạo biểu đồ
        $chart = new Chart;
        $chart->labels(['Doanh thu từ đặt cọc']);
        $chart->dataset('Số tiền đặt cọc', 'bar', [$totalDeposit])
              ->color('rgb(255, 99, 132)');  // Màu của biểu đồ
        
        return view('admin.revenue-statistics', 
        compact('totalDeposit','totalDepositToday', 'totalDepositYesterday', 'chart'));
    } */

    public function showRevenueChart(Request $request)
{
    // Lấy năm hiện tại (hoặc có thể thay đổi theo nhu cầu)
    $year = Carbon::now()->year;

    // Khởi tạo mảng cho doanh thu của tháng 1 và tháng 2
    $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ];
    $revenueData = [];

    foreach ($months as $month) {
        // Lấy số ngày trong tháng (xử lý năm nhuận cho tháng 2)
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // Tạo mảng chứa ngày của tháng
        $days = range(1, $daysInMonth);

        // Lấy doanh thu theo từng ngày trong tháng
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Truy vấn doanh thu theo từng ngày
        $dailyRevenue = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('DAY(created_at) as day, SUM(deposit_amount) as revenue')
            ->groupBy('day')
            ->get();

        // Khởi tạo mảng doanh thu với giá trị ban đầu là 0 cho tất cả các ngày
        $revenues = array_fill(0, $daysInMonth, 0);
        
        // Cập nhật doanh thu cho từng ngày có dữ liệu
        foreach ($dailyRevenue as $revenue) {
            $revenues[$revenue->day - 1] = $revenue->revenue;
        }

        // Lưu dữ liệu vào mảng
        $revenueData[$month] = ['days' => $days, 'revenues' => $revenues];
    }
    //dd($revenueData);

    return view('admin.revenue-statistics', compact('revenueData', 'months', 'year'));
}
}
