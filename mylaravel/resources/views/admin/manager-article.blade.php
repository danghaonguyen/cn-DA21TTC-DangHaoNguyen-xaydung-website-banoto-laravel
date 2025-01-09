@extends('admin.dashboard')

@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
        QUẢN LÝ BÀI VIẾT
    </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Thêm - Sửa / Cập nhật Bài viết</li>
    </ol>

    <div class="container">
        <h2 class="mb-4" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">
            {{ isset($article) ? 'SỬA BÀI VIẾT' : 'THÊM BÀI VIẾT' }}
        </h2>

        <!-- Hiển thị thông báo nếu có -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form thêm bài viết -->
        <form action="{{ isset($article) ? route('admin.manager-article.update', $article->id) : route('admin.manager-article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($article))
            @method('PUT') <!-- Sử dụng phương thức PUT để sửa thông tin bài viết -->
            @endif

            <div class="row">
                <!-- Col 1: Tiêu đề, Tác giả, Ngày đăng -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $article->title ?? '') }}" style="background-color: #f0f2f5;">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Tác giả</label>
                        <input type="text" class="form-control" id="author" name="author" required value="{{ old('author', $article->author ?? '') }}" style="background-color: #f0f2f5;">
                        @error('author')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Ngày đăng</label>
                        <input type="date" class="form-control" id="published_at" name="published_at" required value="{{ old('published_at', $article->published_at ?? '') }}" style="background-color: #f0f2f5;">
                        @error('published_at')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Col 2: Nội dung bài viết và hình ảnh -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung bài viết</label>
                        <textarea class="form-control" id="content" name="content">{{ old('content', $article->content ?? '') }}</textarea>
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="image" name="image" style="background-color: #f0f2f5;">
                        @if(isset($article) && $article->image)
                        <img src="{{ asset('storage/'.$article->image) }}" width="100" class="mt-2">
                        @endif
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary" style="float: right; width: 100px;">{{ isset($article) ? 'Cập nhật' : 'Thêm' }}</button>
            </div>

        </form>
    </div>
</div>

<!-- Thêm CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '{{ route("admin.manager-article.upload") }}?_token={{ csrf_token() }}' // Đảm bảo sử dụng đúng đường dẫn
            },
            toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'link', '|', 'imageUpload' ]  // Bổ sung 'imageUpload' nếu chưa có
        })
        .catch(error => {
            console.error(error);
        });
</script>


<!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '{{ route("admin.manager-article.upload") }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script> -->

@endsection
