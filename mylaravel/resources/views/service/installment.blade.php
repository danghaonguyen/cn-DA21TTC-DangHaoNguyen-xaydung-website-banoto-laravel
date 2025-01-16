@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4">ĐĂNG KÝ MUA XE TRẢ GÓP</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="installment">
        <div class="form-container">

            <form action="{{ route('service.installment.submit') }}" method="POST">
                @csrf
                <div class="form-custom">
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập Họ Tên" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="phone">Số Điện Thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Nhập Số Điện Thoại" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Nhập Email" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="product_id">Xe bạn quan tâm:</label>
                        <select class="form-control" name="product_id" id="product_id" required style="appearance: auto;">
                            <!-- Giả sử bạn đã có danh sách sản phẩm -->
                            <option value="">-- Chọn xe --</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn-custom">Đăng Ký</button>
                    <br>
                    <br>
                    <p style="color: red;">Khi khách hàng đăng ký, chúng tôi sẽ gửi thủ tục quy trình mua trả góp cho khách hàng qua gmail.
                    Hãy check gmail nhé!. </p>
                @if(session('success'))
                <p style="color: green; margin-top:10px">{{ session('success') }}</p>
                @endif
                </div>
               <!--  <br>
                @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
                @endif -->
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <br>
               
            </form>

            <div class="form-right">
                <h4>Mua sẽ trả góp như thế nào ?</h4>
                <p>Là trả trước một phần tiền mua xe, phần còn thiếu sẽ vay ngân hàng rồi hàng tháng
                    trả dần cho ngân hàng cả gốc và lãi theo phương thức trừ lùi trong suốt thời gian trả góp.</p>

                <h5 style="font-style: italic;">Ví dụ: </h5>
                <p style="font-style: italic;">
                    Khách hàng A mua trả góp xe Hyundai Grand i10 1.2 AT trị giá 473
                    triệu theo phương thức: TRẢ TRƯỚC 25% = 118 triệu, phần còn lại là
                    355 triệu sẽ vay ngân hàng với lãi suất 5,99%/năm không đổi trong
                    6 tháng đầu tháng đầu, sau 6 tháng lãi suất là (9.1%/ 1 năm) và trả góp trong
                    5 năm (Cụ thể: sau khi tính toán, mỗi tháng khách hàng A phải trả 1.773.750 VNĐ
                    (tiền lãi cho tháng đầu tiên) và biên độ giảm dần đến tháng cuối cùng là theo quy tắc trừ lùi 2
                    9.563 VNĐ (tiễn lãi tháng cuối cùng). Như vậy trong 5 năm tổng số tiền lãi khách hàng phải
                    chịu là 54.099.375 VNĐ.)
                </p>
            </div>

        </div>
        <div class="row">
            <!-- Cột 1 -->
            <div class="col-md-4">
                <div class="form-bottom">
                    <h4>Lợi ích khi mua xe trả góp</h4>
                    <hr>
                    <p> 1. Số tiền vay lên đến 95% giá trị xe.<br>
                        2. Thời gian vay lên đến 7 năm.<br>
                        3. Tài trợ vay mua xe ô tô mới và xe ô tô đã qua sử dụng.<br>
                        4. Thủ tục vay đơn giản, thời gian xử lý hồ sơ nhanh chóng.<br>
                        5. Phương thức trả nợ linh hoạt: lãi trả hàng tháng/hàng quý,
                        vốn trả theo phương thức vốn góp đều hoặc vốn góp bậc thang giảm dần.
                    </p>
                </div>
            </div>

            <!-- Cột 2 -->
            <div class="col-md-4">
                <div class="form-bottom">
                    <h4>Điều kiện mua xe trả góp</h4>
                    <hr>
                    <p> 1. Cá nhân từ 18 tuổi trở lên.<br>
                        2. Doanh nghiệp thành lập trên 6 tháng.<br>
                        3. Có hợp đồng mua bán xe và các giấy tờ có liên quan.<br>
                        4. Có thu nhập đảm bảo cho việc trả nợ cho Ngân hàng.<br>
                        5. Có tài sản đảm bảo: là chính chiếc xe ô tô mà Quý khách mua, bất động sản hoặc tài sản khác.
                    </p>
                </div>
            </div>

            <!-- Cột 3 -->
            <div class="col-md-4">
                <div class="form-bottom">
                    <h4>Đối tượng thích hợp nhất​</h4>
                    <hr>
                    <p> 1. Doanh nhân, doanh nghiệp: những người có khả năng
                        sử dụng tiền để kinh doanh sinh lời nhiều hơn là
                        tỷ lệ lãi suất tiền cho vay của ngân hàng.<br>
                        2. Thời gian vay lên đến 7 năm.<br>
                        3. Những người rất cần sử dụng xe, sẽ có đủ tiền mua xe
                        trong một tương lai gần nhưng hiện tại chưa tập trung đủ tiền để mua xe trả thẳng.

                    </p>
                </div>
            </div>
        </div>





    </div>



</div>

</section>
@endsection