<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order; 

class OrderController extends Controller
{
    // Phương thức hiển thị danh sách đơn hàng
    public function listOrders()
    {
        // Lấy tất cả các đơn hàng hoặc sử dụng phân trang nếu cần
        // $orders = Order::paginate(10);  // Phân trang 10 đơn hàng mỗi trang
        $orders = Order::all(); 
        
        return view('admin.list-orders', compact('orders'));
    }

    // Phương thức xem chi tiết đơn hàng
    public function viewOrder($orderId)
    {
        // Lấy thông tin đơn hàng theo ID
        $order = Order::findOrFail($orderId);
        // Lấy đơn hàng và thông tin thanh toán
        $order = Order::with('payments')->findOrFail($orderId);

        return view('admin.view-orders', compact('order'));
    }

    // Phương thức xóa đơn hàng
    public function destroy($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Xóa đơn hàng
        $order->delete();

        // Trả về thông báo thành công
        return redirect()->route('admin.list-orders')->with('success', 'Đơn hàng đã được xóa!');
    }
}
