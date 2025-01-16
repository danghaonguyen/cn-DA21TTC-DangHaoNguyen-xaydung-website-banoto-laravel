@extends('admin.dashboard')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        CHI TIẾT ĐƠN HÀNG</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
    </ol>

    <div class="order-detail-card">
    <table class="order-table">
        <tr>
            <th>ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Tên người dùng</th>
            <td>{{ $order->user_name }}</td>
        </tr>
        <tr>
            <th>Số tiền đặt cọc</th>
            <td>{{ number_format($order->deposit_amount, 0, ',', '.') }} VND</td>
        </tr>
        <tr>
            <th>Sản phẩm</th>
            <td>{{ $order->product_name }}</td>
        </tr>
        <tr>
            <th>Phương thức thanh toán</th>
            <td>
                @foreach ($order->payments as $payment)
                        {{ $payment->payment_method }}
                    @endforeach
            </td>
        </tr>
        <tr>
            <th>URL thanh toán</th>
            <td><a href="{{ $order->order_url }}" target="_blank" >Thanh toán</a></td>
        </tr>
    </table>
    <div class="back-button">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm ms-2">
        Quay lại <i class="fa fa-arrow-right"></i> </a>
    </div> 
</div>

    <!-- Hành động duyệt và hủy đơn hàng -->
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            @if ($order->status == 'pending')
            <form action="#" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fa fa-check"></i> Duyệt
                </button>
            </form>
            @elseif ($order->status == 'approved')
            <form action="#" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Hủy
                </button>
            </form>
            @endif

            <!-- Quay lại danh sách đơn hàng -->
            <!-- <a href="{{ route('admin.list-orders') }}" class="btn btn-secondary btn-sm ms-2">
                Quay lại <i class="fa fa-arrow-right"></i>
            </a> -->
        </div>
    </div>

<style>
    /* Giao diện thẻ chi tiết đơn hàng */
.order-detail-card {
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
}

/* Tiêu đề */
.order-title {
    text-align: center;
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* Bảng chi tiết đơn hàng */
.order-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.order-table th,
.order-table td {
    padding: 12px;
    text-align: left;
}

.order-table th {
    background-color: #f1f1f1;
    font-weight: bold;
}

.order-table td {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
}

/* Nút thanh toán */
.btn-primary {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Nút quay lại */
.btn-secondary {
    background-color: #6c757d;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Hover effect cho bảng */
.order-table tr:hover {
    background-color: #f9f9f9;
}

.back-button {
    display: flex;
    justify-content: flex-end; /* Căn phải */
    margin-top: 20px; /* Thêm khoảng cách phía trên nếu cần */
}
</style>
@endsection