<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-start text-white mb-4">
                <h4 style="font-weight: normal;">Website Bán Ô tô - Vibecars</h4>
                <p>Showroom: Số 1, Đường Nguyễn Đáng, Phường 7, Thành phố Trà Vinh, Tỉnh Trà Vinh.</p>
                <p>Showroom: Số 2, Đường Hùng Vương, Phường 5, Thành phố Trà Vinh, Tỉnh Trà Vinh.</p>
                <p>Showroom: Số 10, Đường Lý Thường Kiệt, Phường 3, Thành phố Trà Vinh, Tỉnh Trà Vinh.</p>
                <p>Hotline: 0917 702 292</p>
                <p>Email: haonguyenvn@gmail.com</p>
            </div>

            <div class="col-md-4 text-start text-white mb-4">
                <h4>Thông tin</h4>
                <a href="{{ route('service.test-drive') }}" class="text-white d-block"> Đăng Ký Lái Thử</a>
                <a href="{{ route('service.cost-estimation') }}" class="text-white d-block"> Dự Toán Chi Phí</a>
            </div>

            <div class="col-md-4 text-start text-white mb-4">
                <h4>Xe bán chạy</h4>
                <a href="{{ route('layouts.show', ['id' => 31]) }}" class="text-white d-block"> Toyota Vios</a>
                <a href="{{ route('layouts.show', ['id' => 4]) }}" class="text-white d-block"> Toyota Camry</a>
                <a href="{{ route('layouts.show', ['id' => 5]) }}" class="text-white d-block"> Toyota Corolla Altis</a>
                <a href="{{ route('layouts.show', ['id' => 33]) }}" class="text-white d-block"> Toyota Yaris Cross</a>
                <hr>
                <a href="{{ route('layouts.show', ['id' => 29]) }}" class="text-white d-block"> Honda CR-V</a>
                <a href="{{ route('layouts.show', ['id' => 21]) }}" class="text-white d-block"> Honda City</a>
                <a href="{{ route('layouts.show', ['id' => 9]) }}" class="text-white d-block"> Honda Civic</a>
                <a href="{{ route('layouts.show', ['id' => 30]) }}" class="text-white d-block"> Honda BR-V</a>
                <hr>
                <a href="{{ route('layouts.show', ['id' => 26]) }}" class="text-white d-block"> Hyundai Accent</a>
                <a href="{{ route('layouts.show', ['id' => 3]) }}" class="text-white d-block"> Hyundai Crenta</a>
                <a href="{{ route('layouts.show', ['id' => 2]) }}" class="text-white d-block"> Hyundai Santa Fe</a>
                <a href="{{ route('layouts.show', ['id' => 27]) }}" class="text-white d-block"> Hyundai Elantra</a>
            </div>

            <div class="col-md-4 text-start text-white mb-4">
                <h4>Hotline</h4>    
                <p> Kinh doanh 1: 0901 234 567</p>
                
                <h4>Follow Us</h4>
                <a href="https://www.facebook.com/thayhkk/" class="text-white "><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://github.com/danghaonguyen/cn-DA21TTC-DangHaoNguyen-xaydungwebsite" class="text-white "><i class="fab fa-github"></i> Github</a>
            </div>

            <div class="text-center mt-4">
                <p class="m-0 text-white"><strong>Thiết kế Web Ô tô bởi Hào Nguyên &copy; VIBECARS </strong></p>
                <p class="text-white"><strong>Chúng tôi cung cấp các dòng xe ô tô chất lượng cao với giá cả hợp lý. Khách hàng là trên hết!</strong></p>
            </div>
        </div>
    </div> <!-- Đóng div container -->
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.vostrel.cz/jquery.reel/jquery.reel.js"></script>
<!-- Liên kết với Javascript -->
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
