<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Article;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(8)->get(); // Ở trang home chỉ gán lấy tối đa 8 sản phẩm xe
        $articles = Article::take(3)->get(); // Ở trang home chỉ gán lấy tối đa 3 sản phẩm xe
        // Truyền dữ liệu sang view
        return view('home', compact('products', 'articles')); // Trả về để hiển thị trang home.blade.php

    }

    public function show($id)
    {
        // Lấy thông tin sản phẩm theo ID
        $product = Product::findOrFail($id);  // Lấy thông tin sản phẩm theo ID
        $articles = Article::findOrFail($id); // Lấy thông tin bài viết theo ID
        
        // Trả về view 'show' với dữ liệu sản phẩm
        return view('home', compact('products', 'articles'));
    }
 
}

