@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        DANH SÁCH LỊCH LÁI THỬ XE CỦA KHÁCH HÀNG</h1>
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
                <th>Sản Phẩm Quan Tâm</th>
                <th>Ngày Lái Thử</th>
                <th>Thời Gian</th>
                <th>Địa Điểm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testDriveSchedules as $testDriveSchedule)
                <tr>
                    <td>{{ $testDriveSchedule->testDrive->name }}</td>
                    <td>{{ $testDriveSchedule->testDrive->product->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($testDriveSchedule->date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($testDriveSchedule->time)->format('h:i A') }}</td>
                    <td>{{ $testDriveSchedule->location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
