<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login'); // Nếu chưa đăng nhập, chuyển hướng đến trang login
        }

        // Kiểm tra xem người dùng có vai trò là admin hay không
        $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập

        if ($user && $user->role !== 'admin') {
            // Nếu người dùng không phải là admin, chuyển hướng về trang home
            return redirect()->route('home');
        }

        // Trả về view dashboard cho admin
        return view('admin.dashboard');
    }

    /* public function homeproduct()           // Hiển thị trang home-product.blade.php
    {
        return view('admin.home-product');
    } */


    public function managerproduct()        // Hiển thị trang manager-product.blade.php
    {
        return view('admin.manager-product');
    }


    public function listproduct()           // Hiển thị trang list-product.blade.php
    {
        return view('admin.list-product');
    }

    public function listinstallment()       // Hiển thị trang list-installments.blade.php
    {
        return view('admin.list-installment');
    }

    public function revenue()
    {
        return view('admin.revenue-statistics');
    }

    // Hiển thị trang trong thư mục admin/home-dashboard.blade.php
  


    public function showRevenueChart(Request $request)
    {
        // Lấy năm hiện tại (hoặc có thể thay đổi theo nhu cầu)
        $year = Carbon::now()->year;
  
        // Khởi tạo mảng cho doanh thu của tháng 1 và tháng 2
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
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

        $totalDeposit = Order::sum('deposit_amount');
        //dd($revenueData);
    
        return view('admin.home-dashboard', compact('revenueData', 'months', 'year', 'totalDeposit'));
    }
    
}
