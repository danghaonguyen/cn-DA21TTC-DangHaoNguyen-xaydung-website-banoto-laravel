@extends('admin.dashboard')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        DANH SÁCH SẢN PHẨM</h1>
    <hr>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form tìm kiếm -->
    <h4 class="breadcrumb-item active" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">Tìm kiếm sản phẩm</h4>
    <form action="{{ route('admin.list-product') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">

                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{ old('name', $brandName ?? '') }}">
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Hãng xe</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Ngoại thất</th>
                <th>Nội thất</th>
                <th>Thông số kỹ thuật</th>
                <th>Màu xe</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand->name }}</td>
                <td>{{ number_format($product->price) }} VND</td>
                <td><img src="{{ asset($product->image) }}" width="100" class="img-fluid"></td>
                <td>{!! str_replace('&nbsp;', ' ', $product->description) !!}</td>
                <td>
                    @if($product->image_exterior)
                    @php
                    $exteriorImages = json_decode($product->image_exterior, true);
                    @endphp
                    @foreach($exteriorImages as $eximage)
                    <img src="{{ asset($eximage) }}" width="50" class="m-1 img-fluid" style="object-fit: cover;">
                    @endforeach
                    @else
                    <p>Chưa có ảnh ngoại thất</p>
                    @endif
                </td>
                <td>
                    @if($product->image_interior)
                    @php
                    $interiorImages = json_decode($product->image_interior, true);
                    @endphp
                    @foreach($interiorImages as $inimage)
                    <img src="{{ asset($inimage) }}" width="50" class="m-1 img-fluid" style="object-fit: cover;">
                    @endforeach
                    @else
                    <p>Chưa có ảnh nội thất</p>
                    @endif
                </td>
                <td>
                    @if($product->image_specs)
                    @php
                    $specsImages = json_decode($product->image_specs, true);
                    @endphp
                    @foreach($specsImages as $specsimage)
                    <img src="{{ asset($specsimage) }}" width="50" class="m-1 img-fluid" style="object-fit: cover;">
                    @endforeach
                    @else
                    <p>Chưa có ảnh thông số kỹ thuật</p>
                    @endif
                </td>
                <td>
                    @if($product->image_color)
                    @php
                    $colorImages = json_decode($product->image_color, true);
                    @endphp
                    @foreach($colorImages as $colorimage)
                    <img src="{{ asset($colorimage) }}" width="50" class="m-1 img-fluid" style="object-fit: cover;">
                    @endforeach
                    @else
                    <p>Chưa có màu xe</p>
                    @endif
                </td>
                <td>
                    <!-- Nút Sửa -->
                    <a href="{{ route('admin.manager-product.edit', $product->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Sửa
                    </a>

                    <!-- Form xóa sản phẩm -->
                    <form action="{{ route('admin.list-product.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE') <!-- Chuyển từ POST thành DELETE -->
                        <br>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection