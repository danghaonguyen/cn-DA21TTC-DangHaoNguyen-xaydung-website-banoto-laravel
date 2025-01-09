<?php

namespace App\Http\Controllers;

use App\Services\ZaloPayService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;


class ZaloPayController extends Controller
{
    /* protected $zaloPayService;

    public function __construct(ZaloPayService $zaloPayService)
    {
        $this->zaloPayService = $zaloPayService;
    }

    // Tạo đơn hàng và chuyển hướng đến trang thanh toán
    public function createOrder(Request $request)
    {
        $amount = $request->input('amount', 50000); // Số tiền mặc định 50,000 VND
        $description = 'Thanh toán đơn hàng';
        $items = [
            [
                'itemid' => 'prod1',
                'itemname' => 'Sản phẩm 1',
                'itemprice' => $amount,
                'itemquantity' => 1,
            ],
        ];

        $response = $this->zaloPayService->createOrder($amount, $description, $items);

        if (isset($response['orderurl'])) {
            return redirect($response['orderurl']); // Chuyển hướng đến URL thanh toán của ZaloPay
        }

        return back()->with('error', 'Không thể tạo đơn hàng');
    } */


    /* protected $zaloPayService;

    public function __construct(ZaloPayService $zaloPayService)
    {
        $this->zaloPayService = $zaloPayService;
    }

    // Tạo đơn hàng và chuyển hướng đến trang thanh toán
    public function createOrder(Request $request, $productId)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId); // Tìm sản phẩm theo productId
        $amount = $product->price * 0.1; // Lấy giá sản phẩm
        $description = 'Thanh toán đơn hàng đặt cọc cho ' . $product->name;

        // Tạo danh sách sản phẩm
        $items = [
            [
                'itemid' => $product->id,
                'itemname' => $product->name,
                'itemprice' => $amount,
                'itemquantity' => 1,
            ],
        ];

        // Tạo đơn hàng qua ZaloPay
        $response = $this->zaloPayService->createOrder($amount, $description, $items);

        // Kiểm tra phản hồi từ ZaloPay và chuyển hướng đến trang thanh toán
        if (isset($response['orderurl'])) {
            return redirect($response['orderurl']); // Chuyển hướng đến trang thanh toán
        }

        // Trả về thông báo lỗi nếu không tạo được đơn hàng
        return back()->with('error', 'Không thể tạo đơn hàng');
    } */



    /* protected $zaloPayService;

    public function __construct(ZaloPayService $zaloPayService)
    {
        $this->zaloPayService = $zaloPayService;
    }

    
    public function createOrder(Request $request, $productId)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId); // Lấy sản phẩm từ database theo ID
        $amount = $product->price * 0.1; // Lấy giá sản phẩm và tính số tiền đặt cọc
        $description = 'Thanh toán đơn hàng đặt cọc cho ' . $product->name;
    
        // Tạo danh sách sản phẩm
        $items = [
            [
                'itemid' => $product->id,
                'itemname' => $product->name,
                'itemprice' => $amount,
                'itemquantity' => 1,
            ],
        ];
    
        // Tạo đơn hàng qua ZaloPay
        $response = $this->zaloPayService->createOrder($amount, $description, $items);
    
        // Kiểm tra phản hồi từ ZaloPay và chuyển hướng đến trang thanh toán
        if (isset($response['orderurl'])) {
            // Lấy user_id từ request (được truyền từ view)
            $userId = $request->user_id; // Lấy user_id đã được xác thực trước đó
    
            // Lưu thông tin giao dịch vào cơ sở dữ liệu
            $transaction = new Transaction();
            $transaction->order_id = $response['zptranstoken']; // Mã đơn hàng từ ZaloPay
            $transaction->product_id = $product->id; // Mã sản phẩm
            $transaction->amount = $amount; // Số tiền thanh toán
            $transaction->status = 'pending'; // Trạng thái ban đầu là 'pending'
            $transaction->payment_method = 'ZaloPay'; // Phương thức thanh toán
            $transaction->user_id = $userId; // Lưu user_id từ request
            $transaction->save();
    
            // Chuyển hướng đến trang thanh toán ZaloPay
            return redirect($response['orderurl']);
        }
    
        // Trả về thông báo lỗi nếu không tạo được đơn hàng
        return back()->with('error', 'Không thể tạo đơn hàng');
    }
     */


  /*    protected $zaloPayService;

public function __construct(ZaloPayService $zaloPayService)
{
    $this->zaloPayService = $zaloPayService;
}

public function createOrder(Request $request, $productId)
{
    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $product = Product::findOrFail($productId); // Lấy sản phẩm từ database theo ID
    $amount = $product->price * 0.1; // Lấy giá sản phẩm và tính số tiền đặt cọc
    $description = 'Thanh toán đơn hàng đặt cọc cho ' . $product->name;

    // Tạo danh sách sản phẩm
    $items = [
        [
            'itemid' => $product->id,
            'itemname' => $product->name,
            'itemprice' => $amount,
            'itemquantity' => 1,
        ],
    ];

    // Tạo đơn hàng qua ZaloPay
    $response = $this->zaloPayService->createOrder($amount, $description, $items);

    // Kiểm tra phản hồi từ ZaloPay và chuyển hướng đến trang thanh toán
    if (isset($response['orderurl'])) {
        // Lấy user_id từ request (được truyền từ view)
        $userId = $request->user_id; // Lấy user_id đã được xác thực trước đó

        // Lưu thông tin giao dịch vào cơ sở dữ liệu
        $transaction = new Transaction();
        $transaction->order_id = $response['zptranstoken']; // Mã đơn hàng từ ZaloPay
        $transaction->product_id = $product->id; // Mã sản phẩm
        $transaction->amount = $amount; // Số tiền thanh toán
        $transaction->status = 'pending'; // Trạng thái ban đầu là 'pending'
        $transaction->payment_method = 'ZaloPay'; // Phương thức thanh toán
        $transaction->user_id = $userId; // Lưu user_id từ request
        $transaction->save();

        // Chuyển hướng đến trang thanh toán ZaloPay
        return redirect($response['orderurl']);
    }

    // Trả về thông báo lỗi nếu không tạo được đơn hàng
    return back()->with('error', 'Không thể tạo đơn hàng');
} */

/* public function handlePaymentStatus(Request $request)
{
    // Lấy thông tin trả về từ ZaloPay
    $transactionToken = $request->zptranstoken; // Mã giao dịch trả về từ ZaloPay
    $status = $request->status; // Trạng thái thanh toán trả về từ ZaloPay

    // Kiểm tra trạng thái thanh toán
    $transaction = Transaction::where('order_id', $transactionToken)->first();

    if ($transaction) {
        if ($status == 'SUCCESS') {
            // Nếu thanh toán thành công, cập nhật trạng thái giao dịch
            $transaction->status = 'success';
        } elseif ($status == 'FAIL') {
            // Nếu thanh toán thất bại, cập nhật trạng thái giao dịch
            $transaction->status = 'failed';
        } else {
            // Trạng thái khác (ví dụ: đang chờ xử lý)
            $transaction->status = 'pending';
        }

        // Lưu lại thông tin trạng thái
        $transaction->save();
    }

    // Chuyển hướng về trang xác nhận đơn hàng hoặc trang thanh toán
    return redirect()->route('payment.confirm');
} */



}
