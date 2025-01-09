@extends('layouts.app')

@section('content')

<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">CHÍNH SÁCH BẢO HÀNH</h2>
    <hr class="mb" style="border-top: 4px solid #333;">

    <div class="service">
    <div class="row">
        <div class="col-md-2">
            <!-- Tab Menu for Car Brands -->
            <ul class="nav flex-column" id="warrantyTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="toyota-tab" data-bs-toggle="pill" href="#toyota" role="tab" aria-controls="toyota" aria-selected="true" style="font-size: 18px; padding: 10px 15px;">
                        <i class="fas fa-car"></i> Toyota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hyundai-tab" data-bs-toggle="pill" href="#hyundai" role="tab" aria-controls="hyundai" aria-selected="false" style="font-size: 18px; padding: 10px 15px;">
                        <i class="fas fa-car"></i> Hyundai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="honda-tab" data-bs-toggle="pill" href="#honda" role="tab" aria-controls="honda" aria-selected="false" style="font-size: 18px; padding: 10px 15px;">
                        <i class="fas fa-car"></i> Honda
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <!-- Tab Content -->
            <div class="tab-content" id="warrantyTabsContent">
                <!-- Toyota Tab -->
                <div class="tab-pane fade show active" id="toyota" role="tabpanel" aria-labelledby="toyota-tab">
                    <div class="warranty-info">
                        <h5>1. Thời gian bảo hành:</h5>
                        <p>Chế độ bảo hành bắt đầu được tính ngay kể từ thời điểm xe được giao cho chủ xe đầu tiên. Trong vòng 36 tháng hoặc 100.000 km, tùy thuộc điều kiện nào đến trước, Toyota đảm bảo sẽ sửa chữa hoặc thay thế bất kỳ phụ tùng nào của xe Toyota mới bị hỏng hóc.</p>
                        
                        <p>- Bảo hành ắc quy: Thời hạn bảo hành cho ắc quy là 12 tháng hoặc 20.000 km tùy điều kiện nào đến trước.</p>
                        
                        <p>- Bảo hành ắc quy hybrid: Thời hạn bảo hành ắc quy hybrid là 36 - 60 tháng hoặc 100.000 - 150.000 km (tuỳ loại xe), tùy điều kiện nào đến trước.</p>

                        <p>- Bảo hành lốp: Bảo hành lốp: Ðược bảo hành theo chế độ riêng của nhà sản xuất lốp. Để biết thêm chi tiết, xin quý khách vui lòng tham khảo những trang web sau: Bridgestone, Dunlop, Michelin.</p>

                        <h5>2. Điều kiện bảo hành:</h5>
                        <p>- Xe hoạt động trong điều kiện bình thường.</p>

                        <p>- Nguyên liệu phụ tùng không tốt.</p>

                        <p>- Lỗi lắp ráp.</p>

                        <p>- Trừ những điều kiện ghi trong mục NHỮNG GÌ KHÔNG ĐƯỢC BẢO HÀNH.</p>

                        <h5>3. Phạm vi áp dụng bảo hành: </h5>
                        <p>Bảo hành chỉ áp dụng trong phạm vi nước Cộng hòa Xã hội chủ nghĩa Việt Nam.</p>

                        <h5>4. Bảo hành miễn phí:</h5>
                       <p>Mọi sửa chữa thuộc chế độ bảo hành (phụ tùng, công lao động) là miễn phí.</p>
                    </div>
                </div>

                <!-- Hyundai Tab -->
                <div class="tab-pane fade" id="hyundai" role="tabpanel" aria-labelledby="hyundai-tab">
                    <div class="warranty-info">
                        <h5>1. Thời gian bảo hành:</h5>
                        <p>- Các model: Grand i10, Accent, Elantra, Tucson, Kona, Santa Fe có ngày giao xe từ ngày 01/03/2021: Thời hạn bảo hành xe là 05 năm hoặc 100.000 km tuỳ theo điều kiện nào đến trước.</p>
                        
                        <p>- Tất cả các model Grand i10, Accent, Elantra, Tucson, Kona, Santa Fe có ngày giao xe trước 01/03/2021: Thời hạn bảo hành xe là 03 năm hoặc 100.000 km tuỳ theo điều kiện nào đến trước.</p>

                        <p>- Các model: Santa Fe, Tucson, Kona có ngày giao xe từ 15/07/2020 đến 31/12/2020: Thời hạn bảo hành xe là 05 năm hoặc 100.000 km tuỳ theo điều kiện nào đến trước.</p>

                        <p>- Xe Solati: Thời hạn bảo hành là 3 năm hoặc 100.000km tuỳ theo điều kiện nào đến trước. (riêng một vài bộ phận được quy định trong sổ bảo hành Solati sẽ có thời hạn bảo hành 18 tháng hoặc 50.000km).</p>
                        
                        <h5>2. Điều khoản không bảo hành:</h5>
                        <p>- Trong trường hợp xe ô tô không được bảo dưỡng định kỳ, bảo dưỡng không đầy đủ, không đúng quy định tại Hướng dẫn sử dụng và/hoặc việc bảo dưỡng không được thực hiện bởi Đại Lý Ủy Quyền.</p>
                    
                        <P>- Bảo hành sẽ không được áp dụng cho bất cứ một hư hỏng, tổn thất nào xảy ra do việc sửa chữa hay điều chỉnh không tuân theo các phương pháp đã được quy định tại Hướng dẫn sử dụng và/hoặc bất cứ hư hỏng, tổn thất nào do nguyên nhân của việc sửa chữa, điều chỉnh không được thực hiện bởi Đại Lý Ủy Quyền. </p>

                        <P>- Bảo hành sẽ không được áp dụng cho bất cứ một hư hỏng, tổn thất nào xảy ra do xe ô tô làm việc quá tải, vận hành xe trên địa hình không phù hợp, hoặc vận hành xe không theo các phương pháp được quy định trong Hướng dẫn sử dụng, hoặc vượt quá giới hạn quy định (tải trọng tối đa, số lượng hành khách, tốc độ động cơ và các đặc điểm khác).</p>
                    </div>
                </div>

                <!-- Honda Tab -->
                <div class="tab-pane fade" id="honda" role="tabpanel" aria-labelledby="honda-tab">
                    <div class="warranty-info">
                        <h5>1. Thời gian bảo hành:</h5>
                        <p>Bảo hành 3 năm hoặc 100.000 km cho nhiều dòng xe, nhưng có những quy định đặc biệt cho các dòng xe như Civic Type R.</p>

                        <h5>Quyền lợi:</h5>
                        <p>Bảo hành sửa chữa miễn phí trong phạm vi bảo hành. Các điều kiện không bảo hành bao gồm việc không thực hiện bảo dưỡng định kỳ, sửa chữa không đúng phương pháp, hoặc sử dụng phụ tùng không chính hãng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style> 
.warranty-info h5 {
    font-size: 1.25rem; /* Tăng kích thước chữ */
    font-weight: bold; /* Đậm */
    border: 2px solid #333; /* Viền bao quanh */
    padding: 5px 10px; /* Khoảng cách trong viền */
    margin-bottom: 15px; /* Khoảng cách giữa các phần */
    border-radius: 5px; /* Bo góc viền */
    background-color: #f8f9fa; /* Màu nền sáng */
}

.warranty-info li, p {
    font-size: 1.1rem; /* Tăng kích thước chữ */
    line-height: 1.5; /* Khoảng cách dòng */
    margin-bottom: 15px; /* Khoảng cách giữa các đoạn văn */
}

</style>
@endsection
