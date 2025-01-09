@extends('admin.dashboard') <!-- Layout admin của bạn -->

@section('content')
    <div class="container mt-5">
        <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
            DANH SÁCH ĐƠN HÀNG</h1>
        <hr>
        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Tên người dùng</th>
                    <th>Số tiền đặt cọc trước</th>
                    <th>Ngày đặt cọc</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ number_format($order->deposit_amount, 0, ',', '.') }} VND</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.view-orders', $order->id) }}" class="btn btn-info">Xem</a>
                            <form action="{{ route('admin.list-orders.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

@endsection
