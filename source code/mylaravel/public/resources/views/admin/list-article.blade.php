@extends('admin.dashboard')

@section('content')

<div class="container mt-5">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        DANH SÁCH BÀI VIẾT
    </h1>
    <hr>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.list-article') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px;">
            <!-- Thanh tìm kiếm -->
            <input type="text" name="search" class="form-control" placeholder="Nhập tên bài viết..." value="{{ old('search', request()->input('search')) }}" autocomplete="off">
            <button class="btn btn-primary" type="submit" id="btnNavbarSearch">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Danh sách bài viết -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Tác Giả</th>
                <th>Ngày Đăng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->author }}</td>
                <td>{{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.manager-article.edit', $article->id) }}" class="btn btn-warning">Sửa</a>

                    <form action="{{ route('admin.list-article.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection