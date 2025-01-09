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

    public function homeproduct()           // Hiển thị trang home-product.blade.php
    {
        return view('admin.home-product');
    }


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
    public function home()
    {
        /*  $today = Carbon::today();
        $totalDeposit = Order::whereDate('created_at', $today)->sum('deposit_amount');
        return view('admin.home-dashboard', compact('totalDeposit')); */

        /* $startDate = Carbon::create(2024, 12, 1);  // Ngày bắt đầu (1 tháng 12, 2024)
        $endDate = Carbon::create(2024, 12, 31);  // Ngày kết thúc (31 tháng 12, 2024)

        $totalDepositForMonth = Payment::whereBetween('created_at', [$startDate, $endDate])->sum('payment_amount');*/

        // Lấy doanh thu hôm nay
        $today = Carbon::today();  // Ngày hiện tại
        $totalDepositToday = Order::whereDate('created_at', $today)->sum('deposit_amount');  // Tính tổng doanh thu hôm nay từ cột `total_price`
 
        // Lấy doanh thu hôm qua
        $yesterday = Carbon::yesterday();  // Ngày hôm qua
        $totalDepositYesterday = Order::whereDate('created_at', $yesterday)->sum('deposit_amount');  // Doanh thu hôm qua */

        // Lấy tổng doanh thu
        $totalDeposit = Order::sum('deposit_amount');  // Tổng doanh thu

        // Truyền dữ liệu vào view
        return view('admin.home-dashboard', compact('totalDeposit', 'totalDepositToday', 'totalDepositYesterday'));
    }
}
