<!-- resources/views/admin/list-testdrive.blade.php -->

@extends('admin.dashboard')

@section('content')

<div class="container mt-5">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        DANH SÁCH ĐĂNG KÝ LÁI THỬ</h1>
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
                <th>Ngày Đăng Ký</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testDrives as $testDrive)
                <tr>
                    <td>{{ $testDrive->name }}</td>
                    <td>{{ $testDrive->phone }}</td>
                    <td>{{ $testDrive->email }}</td>
                    <td>{{ $testDrive->car_interest }}</td>
                    <td>{{ $testDrive->created_at->format('d-m-Y') }}</td>
                    <td>
                        <!-- Thêm nút xóa -->
                        <form action="{{ route('admin.list-testdrive.destroyTestDrive', $testDrive->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thông tin này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
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
