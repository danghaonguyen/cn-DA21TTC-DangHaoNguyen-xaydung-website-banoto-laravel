@extends('layouts.app')

@section('content')
<header>
</header>

<div class="container mt-5">
    <h2 class="text-center mb-4">DỰ TOÁN CHI PHÍ</h2>
    <hr class="mb" style="border-top: 4px solid #333;">
    <br>

    <div class="cost-estimation">
        <div class="row">
            <!-- Form 1 -->
            <div class="col-md-6">
                <div class="form-custom">
                    <form method="POST" action="{{ route('service.cost-estimation.calculate') }}">
                        @csrf

                        <!-- Hãng xe -->
                        <div class="form-group">
                            <label for="brand">Hãng xe</label>
                            <select id="brand" name="brand" class="form-control" style="appearance: auto;">
                                <option value="">Chọn hãng xe</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand', request('brand')) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product">Dòng xe</label>
                            <select id="product" name="product" class="form-control" style="appearance: auto;">
                                <option value="">Chọn dòng xe</option>
                                @if(isset($products))
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product', request('product')) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Nơi đăng ký -->
                        <div class="form-group">
                            <label for="location">Chọn nơi</label>
                            <select id="location" name="location" class="form-control" style="appearance: auto;">
                                @foreach ($locations as $location)
                                <option value="{{ $location }}" {{ old('location', request('location')) == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn-custom">Dự toán chi phí</button>
                    </form>
                </div>
            </div>

            <!-- Form 2 -->
            <div class="col-md-6">
                <div class="form-right">
                    @if (isset($result))
                    <div class="result mt-1">
                        <table class="table table-bordered">
                            <tr>
                                <th>Giá xe (bao gồm VAT)</th>
                                <td>{{ number_format($result['car_price'], 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Lệ phí trước bạ</th>
                                <td>{{ number_format($result['registration_fee'], 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Lệ phí đăng ký</th>
                                <td>{{ number_format($result['registration_cost'], 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Phí sử dụng đường bộ</th>
                                <td>{{ number_format($result['road_fee'], 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Bảo hiểm TNDS</th>
                                <td>{{ number_format($result['insurance'], 0, ',', '.') }} VND</td>
                            </tr>
                            <tr>
                                <th>Tổng cộng</th>
                                <td><strong class="text-danger">{{ number_format($result['total'], 0, ',', '.') }} VND</strong></td>
                            </tr>
                        </table>
                        <p class="text-muted">Mức biểu phí trên đây là tạm tính và có thể thay đổi.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <p style="line-height: 2.0; font-size: 20px; color:red; font-weight:bold"> Lưu ý: Chi phí dự toán
            chỉ mang tính tương đối. Để nhận được ” ƯU ĐÃI ĐẶC BIỆT ĐỘC QUYỀN TỪ ĐẠI LÝ ”
            và “TƯ VẤN CHÍNH XÁC NHẤT” khi mua xe, ANH (CHỊ) hãy liên hệ ngay với chúng tôi
            qua số: 0917 702 292 hoặc điền form liên hệ dưới đây. Chúng tôi sẽ liên hệ trong
            thời gian “NHANH NHẤT”. Xin cảm ơn.</p>

        <hr>
        <h4>Bạn Cần Tư Vấn Thêm?</h4>

        <div class="form-container">
            <!-- Form 3 -->
            <div class="form-custom">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập Họ Tên" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="phone">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập Số Điện Thoại" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập Email" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="car-interest">Xe Bạn Quan Tâm</label>
                    <input type="text" class="form-control" id="car-interest" placeholder="Nhập Xe Bạn Quan Tâm" autocomplete="off">
                </div>

                <button type="submit" class="btn-custom">Đăng Ký</button>
            </div>

            <!-- Form 4 -->
            <div class="form-right">
                <center>
                    <img src=" {{ asset('img/vibecars-logo.png') }}" alt="" width="250" height="250" style="border-radius: 50px;">
                    <h4 style="margin-top:15px; font-weight: bold; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> 
                        VIBECARS</h4>

                    <p><strong>Email: haonguyen@outlook.com</strong></p>
                    <button class="btn btn-danger" style="width: 50%; border-radius: 0px;"><Strong><i class="fas fa-phone"></i> 0917 702 292</strong></button>
                </center>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('brand').addEventListener('change', function() {
        const brandId = this.value;
        const productSelect = document.getElementById('product');

        // Reset danh sách dòng xe
        productSelect.innerHTML = '<option value="">Chọn dòng xe</option>';

        if (brandId) {
            fetch(`/get-products/${brandId}`)
                .then(response => response.json())
                .then(products => {
                    products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.id;
                        option.textContent = product.name;
                        productSelect.appendChild(option);
                    });
                });
        }
    });
</script>

@endsection