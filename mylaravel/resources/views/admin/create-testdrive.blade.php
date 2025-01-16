@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mt-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        TẠO LỊCH LÁI THỬ XE CHO KHÁCH HÀNG
    </h1>
    <hr>

    <!-- Hiển thị thông tin khách hàng -->
    <div class="form-group">
        <label for="customer_name">Tên khách hàng</label>
        <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $testDrive->name }}" disabled>
    </div>

    <div class="form-group">
        <label for="customer_phone">Số điện thoại</label>
        <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="{{ $testDrive->phone }}" disabled>
    </div>

    <div class="form-group">
        <label for="customer_email">Email</label>
        <input type="email" name="customer_email" id="customer_email" class="form-control" value="{{ $testDrive->email }}" disabled>
    </div>

    <div class="form-group">
        <!-- ID khách hàng (ẩn) -->
        <input type="text" name="test_drive_id" id="test_drive_id" class="form-control" value="{{ $testDrive->id }}" disabled hidden>
    </div>

    <!-- Form để tạo lịch lái thử -->
    <form action="{{ route('admin.list-testdrive.store', ['id' => $testDrive->id]) }}" method="POST">
        @csrf

        <!-- Ngày lái thử -->
        <div class="form-group">
            <label for="date">Ngày lái thử</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Giờ lái thử -->
        <div class="form-group">
            <label for="time">Thời gian</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ old('time') }}" required>
            @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Địa điểm lái thử -->
        <div class="form-group">
            <label for="location">Địa điểm</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
            @error('location')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <!-- Nút submit -->
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Tạo</button>
        </div>
    </form>
</div>

<style> 
/* Tạo khoảng cách giữa các nhóm form */
.form-group {
    margin-bottom: 20px;
}

/* Cải thiện kiểu dáng của input field */
.form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 14px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

/* Tạo kiểu cho nhãn của input field */
label {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: block;
}

/* Tạo kiểu cho button submit */
button.btn {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    width: 100px;
}

/* Thêm hiệu ứng hover cho button */
button.btn:hover {
    background-color: #2980b9;
}

/* Kiểm tra lỗi */
.text-danger {
    color: #e74c3c;
    font-size: 12px;
    margin-top: 5px;
}

/* Thêm padding cho form */
form {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
}
</style>
@endsection