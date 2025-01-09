<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Installment;  // Sử dụng model Installment
use App\Models\Product;      // Sử dụng model Product
use App\Models\Brand; 
use App\Models\TestDrive;     

class ServiceController extends Controller
{
    public function warranty()
    {               

        return view('service.warranty');     // Trang Bảo hành
    }

    public function accessories()
    {         

        return view('service.accessories'); // Trang Phụ tùng và phụ kiện xe

    }

    public function testDrive()
    {        

        return view('service.test-drive');    // Trang Đăng ký lái thử
    }

    public function installment()
    {           

        return view('service.installment');    // Trang Trả góp
    }

    public function costEstimation()
    {     

        return view('service.cost-estimation');    // Trang Dự toán chi phí
    }


    // Trang service.installment.blade.php

    public function show()
    {
        // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        $products = Product::all();

        // Trả lại view với danh sách sản phẩm
        return view('service.installment', compact('products'));
    }

    // Lưu thông tin khách hàng khi bấm nút đăng ký vào cơ sở dữ liệu
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'product_id' => 'required|exists:products,id',
        ]);

        $installment = new Installment();
        $installment->name = $validated['name'];
        $installment->phone = $validated['phone'];
        $installment->email = $validated['email'];
        $installment->product_id = $validated['product_id'];
        $installment->save();

        return back()->with('success', 'Đăng ký thành công!');
    }


    public function display() // Hiễn thị danh sách khách hàng đã đăng ký mua xe trả góp
    {
        // Lấy tất cả thông tin khách hàng đã đăng ký trả góp
        $installments = Installment::all();

        // Trả về view với dữ liệu đã lấy
        return view('admin.list-installment', compact('installments'));
    }

    public function destroyInstallments($id)
    {
        // Tìm đơn đăng ký mua xe trả góp và xóa
        $installments = Installment::findOrFail($id);
        $installments->delete();

        // Redirect về trang danh sách và thông báo thành công
        return redirect()->route('admin.list-installment')->with('success', 'Thông tin đăng ký đã được xóa.');
    }

    // Phương thức duyệt đơn đăng ký trả góp
    public function approve($id)
    {
        $installment = Installment::find($id);

        // Kiểm tra xem đơn đăng ký có tồn tại không
        if ($installment) {
            $installment->status = 'Đã duyệt'; // Cập nhật trạng thái
            $installment->save(); // Lưu thay đổi vào cơ sở dữ liệu

            // Trở lại danh sách với thông báo thành công
            return redirect()->route('admin.list-installment')->with('success', 'Thông tin đăng ký đã được duyệt.');
        }

        // Trường hợp không tìm thấy đơn đăng ký
        return redirect()->route('admin.list-installment')->with('error', 'Không tìm thấy thông tin đăng ký.');
    }

    public function pending($id)
    {
        $installment = Installment::find($id);

        if ($installment) {
            $installment->status = 'Chưa duyệt'; // Đặt lại trạng thái là "pending"
            $installment->save();

            return redirect()->route('admin.list-installment')->with('success', 'Thông tin đăng ký đã được hủy.');
        }

        return redirect()->route('admin.list-installment')->with('error', 'Không tìm thấy thông tin đăng ký.');
    }



    // Trang service.cost-estimation.blade.php
    public function showForm()
    {
        // Lấy danh sách các hãng xe
        $brands = Brand::all();

        // Danh sách địa điểm cố định
        $locations = ['Hồ Chí Minh', 'Cần Thơ', 'Vĩnh Long', 'Trà Vinh', 'Khác']; // gán địa điểm

        return view('service.cost-estimation', compact('brands', 'locations'));
    }

    public function getProducts($brandId)
    {
        // Lấy danh sách xe dựa trên brand_id
        $products = Product::where('brand_id', $brandId)->get(['id', 'name']);

        // Trả về JSON cho Ajax
        return response()->json($products);
    }

    public function calculate(Request $request)
    {
        // Validate form
        $request->validate([
            'brand' => 'required',
            'product' => 'required',
            'location' => 'required',
        ]);

        // Lấy danh sách dòng xe của hãng xe đã chọn
        $products = Product::where('brand_id', $request->brand)->get();

        // Lấy giá xe từ sản phẩm
        $product = Product::find($request->product);
        if (!$product) {
            return redirect()->back()->withErrors(['product' => 'Dòng xe không hợp lệ']);
        }
        $carPrice = $product->price;

        // Danh sách chi phí theo địa điểm
        $locationCosts = [
            'Hồ Chí Minh' => [
                'registration_fee' => 10,       // Lệ phí trước bạ (%)
                'registration_cost' => 11000000, // Lệ phí đăng ký cố định
                'road_fee' => 1560000          // Phí sử dụng đường bộ
            ],
            'Cần Thơ' => [
                'registration_fee' => 8,
                'registration_cost' => 9500000,
                'road_fee' => 1400000
            ],
            'Trà Vinh' => [
                'registration_fee' => 7,
                'registration_cost' => 8000000,
                'road_fee' => 1200000
            ],
            'Vĩnh Long' => [
                'registration_fee' => 7,
                'registration_cost' => 6000000,
                'road_fee' => 1000000
            ],
            'Khác' => [
                'registration_fee' => 6,
                'registration_cost' => 6000000,
                'road_fee' => 1000000
            ],
        ];

        // Lấy thông tin chi phí cho địa điểm được chọn
        $location = $request->location;
        $locationCost = $locationCosts[$location] ?? null;

        if (!$locationCost) {
            return redirect()->back()->withErrors(['location' => 'Địa điểm không hợp lệ']);
        }

        // Tính toán các chi phí
        $registrationFee = $carPrice * ($locationCost['registration_fee'] / 100); // Lệ phí trước bạ
        $registrationCost = $locationCost['registration_cost'];                  // Lệ phí đăng ký
        $roadFee = $locationCost['road_fee'];                                    // Phí đường bộ
        $insurance = 480700;                                                     // Bảo hiểm TNDS cố định
        $total = $carPrice + $registrationFee + $registrationCost + $roadFee + $insurance;

        // Trả kết quả về view
        return view('service.cost-estimation', [
            'brands' => Brand::all(),
            'locations' => array_keys($locationCosts),
            'products' => $products,
            'result' => [
                'car_price' => $carPrice,
                'registration_fee' => $registrationFee,
                'registration_cost' => $registrationCost,
                'road_fee' => $roadFee,
                'insurance' => $insurance,
                'total' => $total,
            ],
        ]);
    }

// Trang service/test-drive.blade.php

    public function storeTestDrive(Request $request)
    {
        // Xác thực dữ liệu (nếu cần)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'car_interest' => 'required|string|max:255',
        ]);

        // Lưu thông tin vào cơ sở dữ liệu
        $testDrive = new TestDrive();
        $testDrive->name = $validated['name'];
        $testDrive->phone = $validated['phone'];
        $testDrive->email = $validated['email'];
        $testDrive->car_interest = $validated['car_interest'];
        $testDrive->save();

        return redirect()->back()->with('success', 'Đăng ký lái thử thành công!');
    }



    public function showTestDrive()
    {
        // Lấy tất cả các đơn đăng ký lái thử
        $testDrives = TestDrive::all();  // Hoặc dùng paginate() nếu có nhiều dữ liệu

        // Trả về view với danh sách đăng ký lái thử
        return view('admin.list-testdrive', compact('testDrives'));
    }

    // Xóa đơn đăng ký lái thử
    public function destroyTestDrive($id)
    {
        // Tìm đơn đăng ký lái thử và xóa
        $testDrive = TestDrive::findOrFail($id);
        $testDrive->delete();

        // Redirect về trang danh sách và thông báo thành công
        return redirect()->route('admin.list-testdrive')->with('success', 'Thông tin đăng ký đã được xóa.');
    }
}
