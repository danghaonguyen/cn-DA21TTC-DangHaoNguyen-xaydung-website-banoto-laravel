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
                <p>Email: nguyentinovn@gmail.com</p>
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
                <a href="{{ route('layouts.show', ['id' => 23]) }}" class="text-white d-block"> Honda HR-V</a>
                <a href="{{ route('layouts.show', ['id' => 21]) }}" class="text-white d-block"> Honda City</a>
                <a href="{{ route('layouts.show', ['id' => 9]) }}" class="text-white d-block"> Honda Civic</a>
                <a href="{{ route('layouts.show', ['id' => 30]) }}" class="text-white d-block"> Honda BR-V</a>
                <hr>
                <a href="{{ route('layouts.show', ['id' => 26]) }}" class="text-white d-block"> Hyundai Accent</a>
                <a href="{{ route('layouts.show', ['id' => 3]) }}" class="text-white d-block"> Hyundai Crenta</a>
                <a href="{{ route('layouts.show', ['id' => 25]) }}" class="text-white d-block"> Hyundai Grandi10 Sedan</a>
                <a href="{{ route('layouts.show', ['id' => 27]) }}" class="text-white d-block"> Hyundai Elantra</a>
            </div>

            <div class="col-md-4 text-start text-white mb-4">
                <h4>Hotline</h4>    
                <p> Kinh doanh 1: 0901 234 567</p>
                
                <h4>Follow Us</h4>
                <a href="https://www.facebook.com/thayhkk/" class="text-white "><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://github.com/danghaonguyen/cn-DA21TTC-DangHaoNguyen-xaydungwebsite" class="text-white "><i class="fab fa-github"></i> Github</a>
            </div>

            <!-- Google Maps Embed -->
            <div class="col-12 mt-4">
     <!--            <h4 class="text-white">Vị trí của chúng tôi trên bản đồ</h4> -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.0807390261484!2d106.32978097487039!3d9.92723389017449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0174502c862bd%3A0xbaf170c9f38f8cfc!2zMSDEkC4gTmd1eeG7hW4gxJDDoW5nLCBQaMaw4budbmcgNywgVHLDoCBWaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1736965842009!5m2!1svi!2s" 
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>

            <div class="text-center mt-4">
                <p class="m-0 text-white"><strong>Website Ôtô bởi Hào Nguyên &copy; VIBECARS </strong></p>
                <p class="text-white"><strong>Chúng tôi cung cấp các dòng xe ô tô chất lượng cao với giá cả hợp lý. Khách hàng là trên hết!</strong></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.vostrel.cz/jquery.reel/jquery.reel.js"></script>
<script src="{{ asset('js/header.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>

