@extends('admin.dashboard')

@section('content')


<div class="container-fluid px-4">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        QUẢN LÝ SẢN PHẨM
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Thêm - Sửa / Cập nhật Sản Phẩm</li>
    </ol>

    <div class="container">
        <h2 class="mb-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">
            {{ isset($product) ? 'SỬA SẢN PHẨM' : 'THÊM SẢN PHẨM' }}
        </h2>

        <!-- Hiển thị thông báo nếu có -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form thêm/sửa sản phẩm -->
        <form action="{{ isset($product) ? route('admin.manager-product.update', $product->id) : route('admin.manager-product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($product))
            @method('PUT') <!-- Sử dụng phương thức PUT để sửa thông tin sản phẩm -->
            @endif

            <div class="row">
                <!-- Col 1: Tên sản phẩm, Giá, Hãng xe, Mô tả -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $product->name ?? '') }}" style="background-color: #f0f2f5;">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="price" name="price" required value="{{ old('price', $product->price ?? '') }}" style="background-color: #f0f2f5;">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Hãng xe</label>
                        <select name="brand_id" id="brand" class="form-control" required style="background-color: #f0f2f5;">
                            <option value="">Chọn hãng xe</option>
                            @foreach(\App\Models\Brand::all() as $brand)
                            <option value="{{ $brand->id }}" {{ isset($product) && $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Col 2: Hình ảnh và ảnh khác -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" style="background-color: #f0f2f5;">
                        @if(isset($product) && $product->image)
                        <img src="{{ asset($product->image) }}" width="100" class="mt-2">
                        @endif
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_exterior" class="form-label">Ảnh ngoại thất (Chọn nhiều ảnh)</label>
                        <input type="file" class="form-control" id="image_exterior" name="image_exterior[]" multiple style="background-color: #f0f2f5;">
                        @error('image_exterior')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_interior" class="form-label">Ảnh nội thất (Chọn nhiều ảnh)</label>
                        <input type="file" class="form-control" id="image_interior" name="image_interior[]" multiple style="background-color: #f0f2f5;">
                        @error('image_interior')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_specs" class="form-label">Ảnh thông số kỹ thuật (Chọn nhiều ảnh)</label>
                        <input type="file" class="form-control" id="image_specs" name="image_specs[]" multiple style="background-color: #f0f2f5;">
                        @error('image_specs')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_color" class="form-label">Ảnh màu sắc xe (Chọn nhiều ảnh)</label>
                        <input type="file" class="form-control" id="image_color" name="image_color[]" multiple style="background-color: #f0f2f5;">
                        @error('image_color')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary" style="float: right; width: 100px;">{{ isset($product) ? 'Cập nhật' : 'Thêm' }}</button>
            </div>

        </form>
    </div>
</div>

<!-- Thêm CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '{{ route("admin.manager-product.upload") }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>


@endsection