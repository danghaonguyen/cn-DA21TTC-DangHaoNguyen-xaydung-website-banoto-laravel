<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Payment;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function toyota()    // Hiển thị trang sản phẩm thuộc Hãng Toyota
    {
        $products = Product::where('brand_id', '1')->get(); // Lấy theo hãng có id = 1 - Toyota
        return view('products.toyota', compact('products'));
    }

    public function honda()     // Hiển thị trang sản phẩm thuộc Hãng Honda
    {
        $products = Product::where('brand_id', '2')->get(); // Lấy theo hãng có id = 2 - Honda
        return view('products.honda', compact('products'));
    }

    public function hyundai()   // Hiển thị trang sản phẩm thuộc Hãng Hyundai
    {
        $products = Product::where('brand_id', '3')->get(); // Lấy theo hãng có id = 3 - Hyundai
        return view('products.hyundai', compact('products'));
    }

   /*  // Hiển thị trang trong thư mục admin/home-dashboard.blade.php
    public function home()
    {
        $totalDeposit = Payment::sum('payment_amount'); // Hoặc cách tính doanh thu khác
        return view('admin.home-dashboard', compact('totalDeposit'));
    } */



    // Hiển thị danh sách sản phẩm trong thư mục admin/list-product.blade.php
    public function list()
    {
        // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        $products = Product::all();

        // Trả về view item-product và truyền biến $products
        return view('admin.list-product', compact('products'));
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        $brands = Brand::all();
        return view('admin.manager-product', compact('brands'));
    }

    // Thêm sản phẩm mới
    /*  */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand_id' => 'required|exists:brands,id',
            'interior_images' => 'nullable|array',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'exterior_images' => 'nullable|array',
            'exterior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'specs_images' => 'nullable|array',
            'specs_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_images' => 'nullable|array',
            'color_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);

        // Loại bỏ các thẻ <p> và thay thế bằng ký tự xuống dòng
        // $description = strip_tags($request->description);  // Loại bỏ tất cả thẻ HTML

        $description = strip_tags($request->description, '<img><br><p>');



        $product = new Product();
        $product->name = $request->input('name');
        //$product->description = $request->input('description');
        $product->description = $description;
        //$product->description = strip_tags($request->input('description'), '<img>');
        $product->price = $request->input('price');
        $product->brand_id = $request->input('brand_id');

        if ($request->hasFile('image')) {

            $imageName = $request->file('image')->getClientOriginalName(); // Lấy tên gốc của ảnh


            // Di chuyển ảnh vào thư mục public/img/img-car/
            $request->file('image')->move(public_path('img/img-car'), $imageName);


            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $product->image = 'img/img-car/' . $imageName;

            // Lưu đường dẫn ảnh từ mô tả vào cơ sở dữ liệu
            //$product->description .= '<img src="' . asset('img/img-car/' . $imageName) . '" />';
        }

        // Xử lý ảnh cho phần description - mô tả
        if ($request->hasFile('image1')) {

            $imageName1 = $request->file('image1')->getClientOriginalName(); // Lấy tên gốc của ảnh


            // Di chuyển ảnh vào thư mục public/img/img-car/
            $request->file('image1')->move(public_path('img/img-car'), $imageName1);


            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            //$product->image = 'img/img-car/' . $imageName;

            // Lưu đường dẫn ảnh từ mô tả vào cơ sở dữ liệu
            $product->description .= '<img src="' . asset('img/img-car/' . $imageName1) . '" />';
        }



        // Lưu ảnh ngoại thất
        if ($request->hasFile('image_exterior')) {

            $imageNamesExterior = [];

            foreach ($request->file('image_exterior') as $image) {

                $imageNameExterior = $image->getClientOriginalName();

                $image->move(public_path('img/exterior-images'), $imageNameExterior);

                $imageNamesExterior[] = 'img/exterior-images/' . $imageNameExterior;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_exterior = json_encode($imageNamesExterior);
        }

        // Lưu ảnh nội thất
        if ($request->hasFile('image_interior')) {

            $imageNamesInterior = [];

            foreach ($request->file('image_interior') as $image) {

                $imageNameInterior = $image->getClientOriginalName();

                $image->move(public_path('img/interior-images'), $imageNameInterior);

                $imageNamesInterior[] = 'img/interior-images/' . $imageNameInterior;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_interior = json_encode($imageNamesInterior);
        }

        // Lưu ảnh thông số kỹ thuật
        if ($request->hasFile('image_specs')) {

            $imageNamesSpecs = [];

            foreach ($request->file('image_specs') as $specsimage) {

                $imageNameSpecs = $specsimage->getClientOriginalName();

                $specsimage->move(public_path('img/specs-images'), $imageNameSpecs);

                $imageNamesSpecs[] = 'img/specs-images/' . $imageNameSpecs;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_specs = json_encode($imageNamesSpecs);
        }



        // Lưu ảnh màu sắc của xe
        if ($request->hasFile('image_color')) {

            $imageNamesColor = [];

            foreach ($request->file('image_color') as $colorimage) {

                $imageNameColor = $colorimage->getClientOriginalName();

                $colorimage->move(public_path('img/color-images'), $imageNameColor);

                $imageNamesColor[] = 'img/color-images/' . $imageNameColor;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_color = json_encode($imageNamesColor);
        }


        $product->save();

        return redirect()->route('admin.manager-product')->with('success', 'Sản phẩm đã được thêm!');
    }




    // Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        return view('admin.manager-product', compact('product', 'brands'));
    }




    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand_id' => 'required|exists:brands,id',
            'interior_images' => 'nullable|array',
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'exterior_images' => 'nullable|array',
            'exterior_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'specs_images' => 'nullable|array',
            'specs_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_images' => 'nullable|array',
            'color_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Loại bỏ tất cả thẻ HTML từ mô tả
        // $description = strip_tags($request->description); 

        // Loại bỏ tất cả thẻ HTML từ mô tả - trừ thẻ <img>
        $description = strip_tags($request->description, '<img><br><p>');
        $description = str_replace('&nbsp;', ' ', $description); // Loại bỏ &nbsp;


        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $description; // Lưu mô tả đã được loại bỏ thẻ HTML
        //$product->description = $request->input('description');
        //$product->description = strip_tags($request->input('description'), '<img>');
        $product->price = $request->input('price');
        $product->brand_id = $request->input('brand_id');

        if ($request->hasFile('image')) {

            $imageName = $request->file('image')->getClientOriginalName(); // Lấy tên gốc của ảnh


            // Di chuyển ảnh vào thư mục public/img/img-car/
            $request->file('image')->move(public_path('img/img-car'), $imageName);

            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $product->image = 'img/img-car/' . $imageName;

            // Lưu đường dẫn ảnh từ mô tả vào cơ sở dữ liệu
            //$product->description .= '<img src="' . asset('img/img-car/' . $imageName) . '" />';

        }

        if ($request->hasFile('image1')) {

            $imageName1 = $request->file('image1')->getClientOriginalName(); // Lấy tên gốc của ảnh


            // Di chuyển ảnh vào thư mục public/img/img-car/
            $request->file('image1')->move(public_path('img/img-car'), $imageName1);

            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            //$product->image = 'img/img-car/' . $imageName1;

            // Lưu đường dẫn ảnh từ mô tả vào cơ sở dữ liệu
            $product->description .= '<img src="' . asset('img/img-car/' . $imageName1) . '" />';
        }


        // Lưu ảnh ngoại thất
        if ($request->hasFile('image_exterior')) {

            $imageNamesExterior = [];

            foreach ($request->file('image_exterior') as $eximage) {

                $imageNameExterior = $eximage->getClientOriginalName();

                $eximage->move(public_path('img/exterior-images'), $imageNameExterior);

                $imageNamesExterior[] = 'img/exterior-images/' . $imageNameExterior;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_exterior = json_encode($imageNamesExterior);
        }


        // Lưu ảnh nội thất
        if ($request->hasFile('image_interior')) {

            $imageNamesInterior = [];

            foreach ($request->file('image_interior') as $inimage) {

                $imageNameInterior = $inimage->getClientOriginalName();

                $inimage->move(public_path('img/interior-images'), $imageNameInterior);

                $imageNamesInterior[] = 'img/interior-images/' . $imageNameInterior;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_interior = json_encode($imageNamesInterior);
        }


        // Lưu ảnh thông số kỹ thuật
        if ($request->hasFile('image_specs')) {

            $imageNamesSpecs = [];

            foreach ($request->file('image_specs') as $specsimage) {

                $imageNameSpecs = $specsimage->getClientOriginalName();

                $specsimage->move(public_path('img/specs-images'), $imageNameSpecs);

                $imageNamesSpecs[] = 'img/specs-images/' . $imageNameSpecs;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_specs = json_encode($imageNamesSpecs);
        }



        // Lưu ảnh màu sắc của xe
        if ($request->hasFile('image_color')) {

            $imageNamesColor = [];

            foreach ($request->file('image_color') as $colorimage) {

                $imageNameColor = $colorimage->getClientOriginalName();

                $colorimage->move(public_path('img/color-images'), $imageNameColor);

                $imageNamesColor[] = 'img/color-images/' . $imageNameColor;
            }
            // Lưu mảng đường dẫn ảnh nội thất vào cơ sở dữ liệu
            $product->image_color = json_encode($imageNamesColor);
        }


        $product->save();

        return redirect()->route('admin.manager-product')->with('success', 'Sản phẩm đã được cập nhật!');
    }




    // Xử lý chức năng xóa sản phẩm 
    public function destroy($id)
    {
        //dd($id); // In ra giá trị id để kiểm tra

        try {
            $product = Product::findOrFail($id);

            // Kiểm tra nếu sản phẩm tồn tại
            if ($product) {
                // Xóa sản phẩm
                $product->delete();

                return redirect()->route('admin.list-product')->with('success', 'Sản phẩm đã được xóa!');
            } else {
                return redirect()->route('admin.list-product')->with('error', 'Không tìm thấy sản phẩm!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.list-product')->with('error', 'Lỗi khi xóa sản phẩm: ' . $e->getMessage());
        }
    }




    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id); // Nếu không tìm thấy sẽ trả về lỗi 404

        $exteriorImages = json_decode($product->image_exterior, true);
        $interiorImages = json_decode($product->image_interior, true);
        $specsImages = json_decode($product->image_specs, true);
        $colorImages = json_decode($product->image_color, true);


        // Trả về view với dữ liệu sản phẩm
        return view('layouts.show', compact('product', 'exteriorImages', 'interiorImages', 'specsImages', 'colorImages'));
    }





    // Tìm kiếm hãng xe trong list-product.blade.php
    public function search(Request $request)
    {

        // $keyword = $request->input('keyword');
        $brandId = $request->input('brand_id');
        $brandName = $request->input('name');

        $products = Product::query();

        // Tìm kiếm theo tên sản phẩm
        //if ($keyword) {
        //   $products->where('name', 'like', "%$keyword%");
        //}

        // Tìm kiếm theo brand_id
        if ($brandId) {
            $products->where('brand_id', $brandId);
        }

        // Tìm kiếm theo tên hãng
        if ($brandName) {
            $products->whereHas('brand', function ($query) use ($brandName) {
                $query->where('name', 'like', "%$brandName%"); // Tìm kiếm theo tên hãng
            });
        }

        $products = $products->get();

        // Truyền danh sách các brand vào view
        $brands = \App\Models\Brand::all();

        return view('admin.list-product', compact('products', 'brands', 'brandId', 'brandName'));
    }


    public function upload(Request $request)
    {
        // Kiểm tra nếu có file được tải lên
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // Kiểm tra loại file
            if ($file->isValid()) {
                // Tạo tên file duy nhất
                $filename = $file->getClientOriginalName();

                // Lưu file vào thư mục public/img/img-car
                $file->move(public_path('img/img-car'), $filename);

                // Tạo đường dẫn đến file đã tải lên
                $url = asset('img/img-car/' . $filename); // Thêm dấu '/' vào giữa thư mục và tên file



                // Trả về kết quả upload thành công với URL của ảnh
                return response()->json([
                    'uploaded' => true,
                    'url' => $url
                ]);
            }
        }

        // Trả về thông báo lỗi nếu không upload được file
        return response()->json(['uploaded' => false, 'error' => ['message' => 'File upload failed.']]);
    }

    
}
