<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Order;
use Carbon\Carbon;

class RevenueController extends Controller // Thống kê quản lý doanh thu
{
    public function showRevenueChart()
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
    }
}
