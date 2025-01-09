<?php

namespace App\Http\Controllers;

use App\Models\Product; // Model sản phẩm (nếu có)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ZaloPayService;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    /* public function create($product_id)
    {
        // Lấy thông tin sản phẩm từ database
        $product = Product::find($product_id);

        // Kiểm tra nếu không tìm thấy sản phẩm
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
        }

        // Cấu hình ZaloPay
        $config = [
            "appid" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q", // Thay thế bằng key của bạn
            "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3", // Thay thế bằng key của bạn
            "endpoint" => "https://sandbox.zalopay.com.vn/v001/tpe/createorder"
        ];

        // Dữ liệu đơn hàng
        $embeddata = [
            "merchantinfo" => "embeddata123"
        ];
        $items = [
            ["itemid" => $product->id, "itemname" => $product->name, "itemprice" => $product->price, "itemquantity" => 1]
        ];
        $order = [
            "appid" => $config["appid"],
            "apptime" => round(microtime(true) * 1000), // milliseconds
            "apptransid" => date("ymd") . "_" . uniqid(), // mã giao dịch
            "appuser" => "appuse",  // Tên người dùng đăng nhập
            "item" => json_encode($items, JSON_UNESCAPED_UNICODE),
            "embeddata" => json_encode($embeddata, JSON_UNESCAPED_UNICODE),
            "amount" => $product->price,
            "description" => "ZaloPay Integration Demo",
            "bankcode" => "zalopayapp"
        ];

        // Tạo MAC
        $data = implode("|", [
            $order["appid"],
            $order["apptransid"],
            $order["appuser"],
            $order["amount"],
            $order["apptime"],
            $order["embeddata"],
            $order["item"]
        ]);
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

        // Gửi yêu cầu POST tới ZaloPay
        $response = Http::asForm()->post($config["endpoint"], $order);

        // Xử lý kết quả trả về từ ZaloPay
        $result = $response->json();

        // Kiểm tra nếu giao dịch thành công, chuyển hướng đến trang thanh toán ZaloPay
        if ($result['returncode'] == 1) {
            return redirect()->to($result['payurl']);
        } else {
            return redirect()->route('home')->with('error', 'Lỗi tạo đơn hàng ZaloPay');
        }
    } */

    private $zaloPayService;

    public function __construct(ZaloPayService $zaloPayService)
    {
        $this->zaloPayService = $zaloPayService;
    }

    public function createPayment(Request $request, $product_id)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($product_id);

        // Lấy thông tin người dùng từ form (truyền từ show.blade.php)
        $userId = $request->input('user_id');
        $userName = $request->input('user_name'); // Lấy tên người dùng từ form

        // Tính số tiền đặt cọc (10% giá sản phẩm)
        $depositAmount = $product->price * 0.1;

        // Mô tả giao dịch
        $description = "Thanh toán đặt cọc sản phẩm: " . $product->name;

        // URL callback xử lý từ ZaloPay
        $callbackUrl = route('payment.callback');

        // Gửi yêu cầu tạo đơn hàng từ ZaloPay
        $result = app(ZaloPayService::class)->createOrder($depositAmount, $description, $callbackUrl);

        if (isset($result['orderurl'])) {
            // Lưu thông tin đơn hàng vào cơ sở dữ liệu (bảng orders)
            $order = new Order();
            $order->product_name = $product->name;
            $order->product_id = $product_id;
            $order->deposit_amount = $depositAmount;

            $order->order_url = $result['orderurl'];
            $order->user_id = $userId; // Lưu ID người dùng từ form
            $order->user_name = $userName; // Lưu tên người dùng
            $order->save();

            // Lưu thông tin thanh toán vào bảng payments
            $payment = new Payment();
            $payment->order_id = $order->id;  // Liên kết thanh toán với đơn hàng
            $payment->payment_amount = $depositAmount;  // Số tiền thanh toán
            $payment->payment_method = 'ZaloPay';  // Phương thức thanh toán
            $payment->payment_date = now();  // Ngày thanh toán
            $payment->transaction_id = $result['zptranstoken'] ?? $result['apptransid'] ?? null;  // Lấy mã giao dịch từ ZaloPay
            $payment->payment_url = $result['orderurl'];  // URL thanh toán
            $payment->save();  // Lưu vào bảng payments

            // Chuyển hướng đến giao diện thanh toán của ZaloPay
            return redirect($result['orderurl']);
        }

        return redirect()->back()->with('error', 'Không thể tạo đơn hàng.');
    }


    public function callback(Request $request)
    {
        // Lấy dữ liệu từ ZaloPay callback
        $postData = $request->getContent();
        $postDataJson = json_decode($postData, true);

        // Xác thực MAC
        $mac = hash_hmac('sha256', $postDataJson['data'], env('ZALOPAY_KEY2'));
        if ($mac !== $postDataJson['mac']) {
            return response()->json(['returncode' => -1, 'returnmessage' => 'MAC không hợp lệ.']);
        }

        // Giải mã dữ liệu trả về từ ZaloPay
        $data = json_decode($postDataJson['data'], true);

        // Kiểm tra xem trả về có thành công không (returncode = 1)
        if ($data['returncode'] === 1) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = Product::find($data['product_id']);
            if (!$product) {
                return response()->json(['returncode' => -1, 'returnmessage' => 'Sản phẩm không tồn tại.']);
            }

            // Lấy thông tin người dùng từ session
            $userId = session('user_id'); // Lấy user_id từ session
            $userName = session('user_name'); // Lấy user_name từ session

            // Lấy thông tin thanh toán
            $payment = Payment::where('order_id', $data['order_id'])->first();

            if ($payment) {
                // Kiểm tra lại mã giao dịch (apptransid hoặc zptransid)
                $transactionId = $data['apptransid'] ?? $data['zptransid'] ?? null;

                if ($transactionId) {
                    // Cập nhật mã giao dịch vào bảng payments
                    $payment->transaction_id = $transactionId;
                    $payment->save();
                } else {
                    // Nếu không nhận được mã giao dịch
                    return response()->json(['returncode' => -1, 'returnmessage' => 'Mã giao dịch không hợp lệ.']);
                }
            }

            // Cập nhật trạng thái đơn hàng trong bảng orders
            $order = Order::find($data['order_id']);
            if ($order) {
                $order->status = 'paid';  // Cập nhật trạng thái đơn hàng là 'paid'
                $order->save();
            }

            // Redirect về trang chủ và thông báo thành công
            return redirect()->route('home')->with('success', 'Thanh toán thành công! Đơn hàng đã được lưu.');
        }

        // Nếu thanh toán không thành công
        return redirect()->route('home')->with('error', 'Thanh toán thất bại.');
    }


    /* public function checkPaymentStatus(Request $request, $apptransid)
{
    // Gọi dịch vụ để lấy trạng thái thanh toán
    $status = $this->zaloPayService->getPaymentStatus($apptransid);

    // Kiểm tra trạng thái trả về từ ZaloPay
    if (isset($status['returncode']) && $status['returncode'] === 1) {
        // Lấy thông tin đơn hàng và thanh toán
        $order = Order::find($status['order_id']);
        $payment = Payment::where('order_id', $status['order_id'])->first();

        if ($order && $payment) {
            // Cập nhật trạng thái thanh toán thành công
            $payment->payment_status = 'success';
            $payment->transaction_id = $status['apptransid'];  // Lưu mã giao dịch từ ZaloPay
            $payment->save();

            // Cập nhật trạng thái đơn hàng thành 'paid'
            $order->status = 'paid';
            $order->save();

            return redirect()->route('home')->with('success', 'Thanh toán thành công! Đơn hàng đã được lưu.');
        }
    }

    // Nếu thanh toán không thành công
    return redirect()->route('home')->with('error', 'Thanh toán thất bại.');
}
 */


    /* public function momo_payment(Request $request)
    {
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data)
                )
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
       


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/momo/payment";
        $ipnUrl = "http://127.0.0.1:8000/momo/payment";
        $extraData = "";



        $requestId = time() . "";
        $requestType = "payWithATM";

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        //dd($signature);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        //dd($result);
        $jsonResult = json_decode($result, true);  // decode json
        
        

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
        
        //header('Location: ' . $jsonResult['payUrl']);
    } */


    public function momo_payment(Request $request, $product_id)
{
    function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data)
                )
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $product = Product::findOrFail($product_id);
    // $payUrl = $request->input('payUrl');
    // Lấy thông tin người dùng từ form (truyền từ show.blade.php)
    $userId = $request->input('user_id');
    $userName = $request->input('user_name');

    // Tính số tiền đặt cọc (10% giá sản phẩm)
    $depositAmount = $product->price * 0.02;

    // Lưu thông tin vào bảng 'orders'
    $order = Order::create([
        'product_name' => $product->name, 
        'product_id' => $product->id, 
        'deposit_amount' => $depositAmount, 
        'order_url' => "",  // Bạn có thể thêm URL thanh toán MoMo ở đây sau khi nhận kết quả từ MoMo
        'user_id' => $userId,
        'user_name' => $userName,
    ]);

    // Lưu thông tin vào bảng 'payments' ngay sau khi tạo đơn hàng
    $payment = Payment::create([
        'order_id' => $order->id,  // Lưu ID đơn hàng
        'payment_amount' => $depositAmount,  // Số tiền thanh toán
        'payment_method' => 'MoMo', // Phương thức thanh toán (có thể lấy từ MoMo nếu có)
        'payment_date' => now(),  // Ngày giờ thanh toán
        'payment_url' => '',
        'transaction_id' => '', // Bạn có thể thêm URL thanh toán của MoMo sau khi nhận kết quả từ MoMo
    ]);

    // Lấy URL thanh toán từ MoMo sau khi gửi yêu cầu
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = $depositAmount; // Sử dụng số tiền đặt cọc làm số tiền thanh toán
    $orderId = time() . "";
    $redirectUrl = "http://127.0.0.1:8000/";
    $ipnUrl = "http://127.0.0.1:8000/momo/payment";
    $extraData = "";

    // Tạo chuỗi HMAC SHA256
    $requestId = time() . "";
    $requestType = "payWithATM";
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Dữ liệu gửi đến MoMo
    $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test", 
        'storeId' => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    );

    // Gửi yêu cầu tới MoMo và nhận kết quả
    $result = execPostRequest($endpoint, json_encode($data));
    //dd($result);
    $jsonResult = json_decode($result, true);  // decode json

    // Cập nhật lại thông tin bảng 'payments' với URL thanh toán và mã giao dịch
    $order->update([
        'order_url' => $jsonResult['payUrl'],  // URL thanh toán MoMo
    ]);

    $payment->update([
        'payment_url' => $jsonResult['payUrl'],
        'transaction_id' => $jsonResult['orderId'],  // URL thanh toán MoMo
    ]);
    

    // Chuyển hướng đến URL thanh toán của MoMo
    return redirect()->to($jsonResult['payUrl']);
}

public function cancelTransaction($product_id)
{
    // Logic xử lý hủy giao dịch nếu có

    // Đảm bảo truyền tham số đúng khi quay lại trang thanh toán
    return redirect()->route('layouts.show', ['product_id' => $product_id])->with('error', 'Thanh toán thất bại! Vui lòng thử lại.');
}

}
