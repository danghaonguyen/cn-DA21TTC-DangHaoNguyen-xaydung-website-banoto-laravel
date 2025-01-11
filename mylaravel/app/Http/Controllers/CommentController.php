<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Hàm tạo bình luận
    public function store(Request $request, $article_id)
    {
        // Kiểm tra người dùng đã đăng nhập
        if (Auth::check()) {
            // Validate dữ liệu nhập vào
            $request->validate([
                'content' => 'required|min:5|max:500',
            ]);

            // Lấy bài viết tương ứng
            $article = Article::findOrFail($article_id);

            // Tạo bình luận mới
            $comment = new Comment();
            $comment->content = $request->input('content');
            $comment->user_id = Auth::id();  // Lấy ID người dùng đã đăng nhập
            $comment->article_id = $article_id;  // Lưu ID bài viết

            $comment->save();

            // Quay lại trang chi tiết bài viết
            return redirect()->route('article-details', $article_id)->with('success', 'Bình luận của bạn đã được đăng!');
        }

        // Nếu chưa đăng nhập
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để bình luận!');
    }

    // Phương thức để hiển thị form sửa bình luận
    public function edit($id)
    {
        // Lấy bình luận từ database
        $comment = Comment::findOrFail($id);

        // Chuyển hướng về trang chi tiết bài viết với dữ liệu bình luận
        return redirect()->route('article-details', $comment->article_id)->with('edit_comment', $comment);
    }

    // Phương thức để cập nhật bình luận
    public function update(Request $request, $id)
    {
        // Lấy bình luận từ database
        $comment = Comment::findOrFail($id);

        // Cập nhật nội dung bình luận
        $comment->content = $request->input('content');
        $comment->save();

        // Chuyển hướng lại trang chi tiết bài viết với thông báo thành công
        return redirect()->route('article-details', $comment->article_id)->with('success', 'Bình luận đã được cập nhật!');
    }

    // Phương thức để xóa bình luận
    public function destroy($id)
    {
        // Lấy bình luận từ database
        $comment = Comment::findOrFail($id);

        // Xóa bình luận
        $comment->delete();

        // Chuyển hướng lại trang chi tiết bài viết với thông báo thành công
        return redirect()->route('article-details', $comment->article_id)->with('success', 'Bình luận đã được xóa!');
    }
}
