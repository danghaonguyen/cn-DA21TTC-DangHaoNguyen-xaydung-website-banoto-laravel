@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        DANH SÁCH KHÁCH HÀNG MUA XE TRẢ GÓP
    </h1>
    <hr>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Khách Hàng</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Xe Khách Hàng Quan Tâm</th>
                <th>Ngày đăng ký</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>  <!-- Thêm cột cho các hành động (Duyệt, Hủy, Xóa) -->
            </tr>
        </thead>
        <tbody>
            @foreach ($installments as $installment)
            <tr>
                <td>{{ $installment->name }}</td>
                <td>{{ $installment->phone }}</td>
                <td>{{ $installment->email }}</td>
                <td>{{ $installment->product ? $installment->product->name : 'Không có xe' }}</td>
                <td>{{ $installment->created_at->format('d-m-Y') }}</td>
                <td>
                    @if ($installment->status == 'Chưa duyệt')
                    <form action="{{ route('admin.list-installment.approve', $installment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">
                            Duyệt
                        </button>
                    </form>
                    @elseif ($installment->status == 'Đã duyệt')
                    <form action="{{ route('admin.list-installment.pending', $installment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Hủy
                        </button>
                    </form>
                    @endif
                    <!-- <form action="{{ route('admin.list-installment.destroyInstallments', $installment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thông tin này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Xóa
                        </button>
                    </form> -->
                </td>
                <td>
                <form action="{{ route('admin.list-installment.sendEmail', $installment->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">Gửi email</button>
    </form>
                <form action="{{ route('admin.list-installment.destroyInstallments', $installment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thông tin này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
