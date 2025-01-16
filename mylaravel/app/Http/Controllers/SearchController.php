<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }


    public function search(Request $request)
    {
        // Lấy giá trị từ form tìm kiếm
        $keyword = $request->input('keyword');

        // Tìm kiếm theo tên sản phẩm và tên hãng xe
        $products = Product::where('name', 'like', "%$keyword%")
            ->orWhereHas('brand', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->get();

        // Trả về kết quả tìm kiếm
        return view('search', compact('products', 'keyword'));
    }
}
