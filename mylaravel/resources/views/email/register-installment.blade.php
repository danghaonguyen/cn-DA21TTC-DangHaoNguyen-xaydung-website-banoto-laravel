<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin hồ sơ mua xe trả góp</title>
</head>
<body>
    <h2>Chào {{ $name }},</h2>
    <p>Cảm ơn bạn đã đăng ký mua xe trả góp. Dưới đây là các thông tin cần chuẩn bị hồ sơ:</p>
    
    <ul>
        <li><strong>Tên khách hàng:</strong> {{ $name }}</li>
        <li><strong>Số điện thoại:</strong> {{ $phone }}</li>
        <li><strong>Sản phẩm quan tâm:</strong> {{ $product }}</li>
    </ul>

    <h3>Các giấy tờ cần chuẩn bị:</h3>
    <ul>
        @foreach ($documents as $document)
            <li>{{ $document }}</li>
        @endforeach
    </ul>

    <h3>Các bước tiếp theo:</h3>
    <ul>
        @foreach ($steps as $step)
            <li>{{ $step }}</li>
        @endforeach
    </ul>

    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để hoàn tất thủ tục.</p>
    <p>Nếu bạn gặp bất kỳ khó khăn nào hoặc cần thêm thông tin, đừng ngần ngại liên hệ với chúng tôi:</p>
    <p>Số điện thoại: <b>0917 702 292</b></p>
    <p>Email:<b> nguyentinovn@gmail.com</b></p>
    <p>Địa chỉ:<b> Đại lý cửa hàng bán Ôtô Vibecars, Số 1, Đường Nguyễn Đáng, Phường 7, Thành phố Trà Vinh, Tỉnh Trà Vinh.</b></p>
    <p>Chúc bạn một ngày tốt lành!</p>
</body>
</html>
