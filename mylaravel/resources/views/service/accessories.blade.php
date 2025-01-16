@extends('layouts.app')

@section('content')

<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4">PHỤ TÙNG VÀ PHỤ KIỆN XE</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="service">
        <!-- Tab menu -->
        <ul class="nav nav-tabs" id="carTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="toyota-tab" data-bs-toggle="tab" href="#toyota" role="tab" aria-controls="toyota" aria-selected="true">Toyota</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="honda-tab" data-bs-toggle="tab" href="#honda" role="tab" aria-controls="honda" aria-selected="false">Honda</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="hyundai-tab" data-bs-toggle="tab" href="#hyundai" role="tab" aria-controls="hyundai" aria-selected="false">Hyundai</a>
            </li>
        </ul>

        <div>
            <!-- Tab content -->
            <div class="tab-content" id="carTabsContent">
                <!-- Toyota Tab -->
                <div class="tab-pane fade show active" id="toyota" role="tabpanel" aria-labelledby="toyota-tab">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Hàng</th>
                                <th>Đơn Vị Tính</th>
                                <th>Số Lượng</th>
                                <th>Tính Năng</th>
                                <th>Giá Bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Áo trùm xe - 4 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>550,000 VND</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Áo trùm xe - 7 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>630,000 VND</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Thảm lót sàn xe</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Giúp giữ sàn xe sạch sẽ</td>
                                <td>350,000 VND</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Camera hành trình</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Ghi lại hành trình lái xe</td>
                                <td>1,200,000 VND</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Chắn bùn xe</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Bảo vệ dưới gầm xe</td>
                                <td>150,000 VND</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Bọc vô lăng xe</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Bảo vệ vô lăng khỏi bụi bẩn, mồ hôi</td>
                                <td>100,000 VND</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Hệ thống âm thanh ô tô</td>
                                <td>Set</td>
                                <td>1</td>
                                <td>Cung cấp âm thanh chất lượng cao cho xe hơi.</td>
                                <td>5,500,000 VND</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Hệ thống GPS định vị</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Giúp lái xe dễ dàng đến các địa điểm mới</td>
                                <td>2,000,000 VND</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Đèn pha LED</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Lái xe an toàn hơn vào ban đêm</td>
                                <td>800,000 VND</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Giàn lạnh ô tô</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Giữ cho không khí trong xe luôn mát mẻ, thoải mái</td>
                                <td>4,500,000 VND</td>
                            </tr>

                            <!-- Add more Toyota accessories -->
                        </tbody>
                    </table>
                </div>

                <!-- Honda Tab -->
                <div class="tab-pane fade" id="honda" role="tabpanel" aria-labelledby="honda-tab">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Hàng</th>
                                <th>Đơn Vị Tính</th>
                                <th>Số Lượng</th>
                                <th>Tính Năng</th>
                                <th>Giá Bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Áo trùm xe - 4 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>550,000 VND</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Áo trùm xe - 7 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>630,000 VND</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Logo Honda đèn LED</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Thêm điểm nhấn ánh sáng cho logo của xe Honda</td>
                                <td>550,000 VND</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ốp cửa xe Honda</td>
                                <td>Cái</td>
                                <td>4</td>
                                <td>Chống trầy xước cho cửa xe, bảo vệ sơn</td>
                                <td>1,200,000 VND</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Đèn sương mù Honda</td>
                                <td>Cái</td>
                                <td>2</td>
                                <td>Cung cấp ánh sáng khi lái xe trong điều kiện sương mù</td>
                                <td>1,000,000 VND</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Hệ thống chống trộm Honda</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Chống trộm, bảo vệ xe khỏi bị lấy cắp</td>
                                <td>2,000,000 VND</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Vòi phun nước gạt mưa Honda</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Cải thiện tầm nhìn trong điều kiện mưa to</td>
                                <td>300,000 VND</td>
                            </tr>
                            <!-- Add more Honda accessories -->
                        </tbody>
                    </table>
                </div>

                <!-- Hyundai Tab -->
                <div class="tab-pane fade" id="hyundai" role="tabpanel" aria-labelledby="hyundai-tab">
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Hàng</th>
                                <th>Đơn Vị Tính</th>
                                <th>Số Lượng</th>
                                <th>Tính Năng</th>
                                <th>Giá Bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Áo trùm xe - 4 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>550,000 VND</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Áo trùm xe - 7 chỗ</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Che mưa, nắng, bụi</td>
                                <td>630,000 VND</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Logo Hyundai đèn LED</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Thêm ánh sáng cho logo Hyundai vào ban đêm</td>
                                <td>600,000 VND</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Thảm lót sàn Hyundai</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Giúp giữ sàn xe sạch sẽ, dễ dàng vệ sinh</td>
                                <td>400,000 VND</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Chắn bùn Hyundai</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Bảo vệ gầm xe khỏi bụi, bùn và các vật liệu khác</td>
                                <td>200,000 VND</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Camera hành trình Hyundai</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Ghi lại hành trình lái xe, giúp bảo vệ trong các tình huống giao thông</td>
                                <td>1,500,000 VND</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Đèn pha LED Hyundai</td>
                                <td>Cái</td>
                                <td>1</td>
                                <td>Cung cấp ánh sáng mạnh mẽ, giúp lái xe an toàn vào ban đêm</td>
                                <td>850,000 VND</td>
                            </tr>
                            <!-- Add more Hyundai accessories -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Đảm bảo rằng bảng không vượt quá chiều rộng cố định */
.table-container {
    width: 100%; /* Chiếm toàn bộ chiều rộng của container */
    max-width: 100%; /* Giới hạn độ rộng tối đa */
    overflow-x: auto; /* Cho phép cuộn ngang khi bảng quá rộng */
}

/* Cố định chiều cao cho bảng, và cho phép cuộn khi nội dung dài */
.table {
    width: 100%;
    height: 400px; /* Điều chỉnh chiều cao theo nhu cầu */
    overflow-y: none; /* Cho phép cuộn dọc khi bảng có nhiều dòng */
    display: block; /* Đảm bảo bảng có thể cuộn */
}

/* Tùy chỉnh bảng và phần nội dung bên trong */
.table th, .table td {
    text-align: center; /* Căn giữa các ô trong bảng */
    vertical-align: middle; /* Căn giữa theo chiều dọc */
    padding: 10px; /* Thêm khoảng cách trong ô bảng */
    border: 1px solid #ddd; /* Thêm viền cho các ô bảng */
}

/* Tùy chỉnh độ rộng cột, ví dụ: */
.table th:nth-child(1), .table td:nth-child(1) {
    width: 10%; /* Độ rộng của cột STT */
}

.table th:nth-child(2), .table td:nth-child(2) {
    width: 30%; /* Độ rộng của cột Tên Hàng */
}

.table th:nth-child(3), .table td:nth-child(3) {
    width: 20%; /* Độ rộng của cột Đơn Vị Tính */
}

.table th:nth-child(4), .table td:nth-child(4) {
    width: 10%; /* Độ rộng của cột Số Lượng */
}

.table th:nth-child(5), .table td:nth-child(5) {
    width: 20%; /* Độ rộng của cột Tính Năng */
}

.table th:nth-child(6), .table td:nth-child(6) {
    width: 10%; /* Độ rộng của cột Giá Bán */
}
    </style>

@endsection