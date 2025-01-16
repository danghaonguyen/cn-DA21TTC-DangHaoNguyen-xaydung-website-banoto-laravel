<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Lái Thử</title>
</head>
<body>
    <h2>Chào {{ $name }},</h2>
    <p>Cảm ơn bạn đã đăng ký lái thử. Bên cửa hàng chúng tôi đã lên lịch cho bạn với thông tin như sau:</p>
    <ul>
        <li><strong>Tên khách hàng:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Sản phẩm khách hàng đã chọn:</strong> {{ $productName }}</li>  <!-- Hiển thị tên sản phẩm -->
        <li><strong>Ngày lái thử:</strong> {{ $formattedDate }}</li>
        <li><strong>Thời gian:</strong> {{  $formattedTime }}</li>
        <li><strong>Địa điểm:</strong> {{ $location }}</li>
    </ul>

    <p>Nếu bạn gặp bất kỳ khó khăn nào hoặc cần thêm thông tin, đừng ngần ngại liên hệ với chúng tôi:</p>
    <p>Số điện thoại: <b> 0917 702 292</b></p>
    <p>Email: <b>nguyentinovn@gmail.com</b></p>
    <p>Chúc bạn có một ngày tốt lành!</p>
</body>
</html>
