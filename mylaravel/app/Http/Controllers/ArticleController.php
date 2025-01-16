<?php

namespace App\Http\Controllers;

use App\Models\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Lấy tất cả bài viết từ cơ sở dữ liệu
        $articles = Article::all();

        // Trả dữ liệu bài viết vào view 'article.blade.php'

        return view('article', compact('articles'));  // Trả về view để hiển thị trang article.blade.php
    }

    public function show() // Hiển thị trang manager-article.blade.php trong /admin
    {
        return view('admin.manager-article');
    }

    // Tạo thêm và lưu bài viết vào csdl
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Tạo mới bài viết
        $article = new Article();
        $article->title = $request->title;
        $article->author = $request->author;
        $article->published_at = $request->published_at;

        $content = $request->input('content');

        // Loại bỏ tất cả các thẻ HTML
        $content = strip_tags($content, '<img>');

        // Thay thế &nbsp; bằng khoảng trắng
        $content = str_replace('&nbsp;', ' ', $content);

        // Xóa phần 'http://127.0.0.1:8000' trong đường dẫn hình ảnh
        $content = str_replace('http://127.0.0.1:8000/', '', $content);

        // Lưu nội dung đã xử lý vào bài viết
        $article->content = $content;


        // Lưu hình ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            // Lấy tên file gốc
            $originalName = $request->file('image')->getClientOriginalName();

            // Lưu hình ảnh với tên file gốc trong thư mục 'public/img/article'
            $imagePath = $request->file('image')->storeAs('img/article', $originalName, 'public');

            // Lưu đường dẫn vào cơ sở dữ liệu (lưu đường dẫn tương đối đến hình ảnh)
            $article->image = $imagePath;
        }


        // Lưu vào cơ sở dữ liệu
        $article->save();

        return redirect()->route('admin.manager-article.store')->with('success', 'Bài viết đã được thêm!');
    }

    // Thuộc tính content xài CKEditor, gọi phương thức upload để upload hình ảnh lên
    public function upload(Request $request)
    {
        // Kiểm tra nếu có file
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Lấy tên gốc của file
            $fileName = $file->getClientOriginalName();

            // Di chuyển file vào thư mục 'public/img/article'
            $file->move(public_path('img/article'), $fileName);

            // Trả về URL của file (chỉ cần phần img/article/)
            $filePath = 'img/article/' . $fileName;

            // Trả về URL hình ảnh cho CKEditor
            return response()->json([
                'uploaded' => true,
                'url' => asset($filePath) // URL đầy đủ của hình ảnh
            ]);
        }

        // Trả về lỗi nếu không có file tải lên
        return response()->json(['uploaded' => false], 400);
    }



    // Phương thức edit - Sửa bài viết
    public function edit($id)
    {
        // Tìm bài viết theo ID
        $article = Article::findOrFail($id);

        // Trả về view edit với dữ liệu bài viết
        return view('admin.manager-article', compact('article'));
    }

    // Phương thức update - Cập nhật bài viết
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Tìm bài viết theo ID
        $article = Article::findOrFail($id);

        // Cập nhật thông tin bài viết
        $article->title = $request->title;
        $article->author = $request->author;
        $article->published_at = $request->published_at;

        $content = $request->input('content');

        // Loại bỏ tất cả các thẻ HTML ngoại trừ <img>
        $content = strip_tags($content, '<img>');

        // Thay thế &nbsp; bằng khoảng trắng
        $content = str_replace('&nbsp;', ' ', $content);

        // Xóa phần 'http://127.0.0.1:8000' trong đường dẫn hình ảnh
        $content = str_replace('http://127.0.0.1:8000/', '', $content);

        // Cập nhật nội dung bài viết
        $article->content = $content;

        // Lưu hình ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            // Lấy tên file gốc
            $originalName = $request->file('image')->getClientOriginalName();

            // Lưu hình ảnh với tên file gốc trong thư mục 'public/img/article'
            $imagePath = $request->file('image')->storeAs('img/article', $originalName, 'public');

            // Cập nhật đường dẫn vào cơ sở dữ liệu
            $article->image = $imagePath;
        }

        // Lưu bài viết đã cập nhật vào cơ sở dữ liệu
        $article->save();

        return redirect()->route('admin.manager-article')->with('success', 'Bài viết đã được cập nhật!');
    }


    // Phương thức destroy - Xóa bài viết
    public function destroy($id)
    {
        // Tìm bài viết theo ID
        $article = Article::findOrFail($id);

        // Xóa bài viết
        $article->delete();

        // Trả về thông báo thành công
        return redirect()->route('admin.list-article')->with('success', 'Bài viết đã được xóa!');
    }

    // Phương thức list - Danh sách bài viết

    public function list()
    {
        // Lấy tất cả bài viết
        $articles = Article::all();
        return view('admin.list-article', compact('articles'));
    }

    public function viewDetails($id)
    {
        // Tìm bài viết theo ID
        $article = Article::findOrFail($id); // Nếu không tìm thấy sẽ trả về lỗi 404

        // Trả về view với dữ liệu bài viết
        return view('article-details', compact('article'));
    }


    // Tìm kiếm bài viết

    public function search(Request $request)
    {
        // Lấy giá trị tìm kiếm từ form
        $query = $request->input('search');

        // Tìm kiếm bài viết theo tên (tiêu đề) nếu có
        $articles = Article::where('title', 'LIKE', "%$query%")->get();

        // Trả về kết quả tìm kiếm vào view list-article
        return view('admin.list-article', compact('articles'));
    }
}
