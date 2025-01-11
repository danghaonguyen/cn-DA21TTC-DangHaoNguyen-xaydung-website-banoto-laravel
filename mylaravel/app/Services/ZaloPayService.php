<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZaloPayService
{
    /* protected $config;

    public function __construct()
    {
        $this->config = [
            "appid" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
            "endpoint" => "https://sandbox.zalopay.com.vn/v001/tpe/createorder"
        ];
    }

    public function createOrder($amount, $description, $items)
    {
        $order = [
            "appid" => $this->config["appid"],
            "apptime" => round(microtime(true) * 1000), // miliseconds
            "apptransid" => date("ymd") . "_" . uniqid(), // mã giao dịch có định dạng yyMMdd_xxxx
            "appuser" => "demo_user", // Tên người dùng
            "item" => json_encode($items, JSON_UNESCAPED_UNICODE),
            "amount" => $amount,
            "description" => $description,
            "embeddata" => json_encode(["merchantinfo" => "custom data"], JSON_UNESCAPED_UNICODE),
            "bankcode" => "", // Để trống để hiển thị tất cả tùy chọn thanh toán (Ví, ATM, Credit Card)
        ];

        // Tạo MAC (chuỗi xác thực)
        $data = $order["appid"] . "|" . $order["apptransid"] . "|" . $order["appuser"] . "|" . $order["amount"]
            . "|" . $order["apptime"] . "|" . $order["embeddata"] . "|" . $order["item"];
        $order["mac"] = hash_hmac("sha256", $data, $this->config["key1"]);

        // Gửi yêu cầu HTTP đến ZaloPay
        $response = Http::asForm()->post($this->config["endpoint"], $order);

        // Trả về kết quả
        return $response->json();
    } */


    private $appId;
    private $key1;
    private $key2;
    private $endpoint;

    public function __construct()
    {
        $this->appId = env('ZALOPAY_APPID');
        $this->key1 = env('ZALOPAY_KEY1');
        $this->key2 = env('ZALOPAY_KEY2');
        $this->endpoint = env('ZALOPAY_ENDPOINT');
    }

    /**
     * Tạo đơn hàng ZaloPay
     */
    public function createOrder($amount, $description, $callbackUrl)
{
    $items = [
        ["itemid" => "item1", "itemname" => "Sample Item", "itemprice" => $amount, "itemquantity" => 1]
    ];

    $embeddata = ["merchantinfo" => "embeddata123"];

    $data = [
        "appid" => $this->appId,
        "apptime" => round(microtime(true) * 1000),
        "apptransid" => date("ymd") . "_" . uniqid(),
        "appuser" => "demo_user",
        "item" => json_encode($items, JSON_UNESCAPED_UNICODE),
        "embeddata" => json_encode($embeddata, JSON_UNESCAPED_UNICODE),
        "amount" => $amount,
        "description" => $description,
        "callback_url" => $callbackUrl, // Callback xử lý từ ZaloPay
        "redirect_url" => url('/home'), // Chuyển người dùng về trang Home
        "bankcode" => "",
    ];

    $macData = implode('|', [
        $data['appid'],
        $data['apptransid'],
        $data['appuser'],
        $data['amount'],
        $data['apptime'],
        $data['embeddata'],
        $data['item'],
    ]);

    $data['mac'] = hash_hmac('sha256', $macData, $this->key1);

    $response = Http::asForm()->post($this->endpoint, $data);

    return $response->json();
}


    /**
     * Xác minh callback từ ZaloPay
     */
    public function verifyCallback($request)
    {
        $postdata = $request->getContent();
        $postdatajson = json_decode($postdata, true);

        // Xác thực chữ ký MAC
        $mac = hash_hmac('sha256', $postdatajson['data'], $this->key2);

        if ($mac !== $postdatajson['mac']) {
            return [
                'returncode' => -1,
                'returnmessage' => 'Chữ ký MAC không hợp lệ. Dữ liệu không đáng tin cậy.'
            ];
        }

        $data = json_decode($postdatajson['data'], true);

        // Kiểm tra trạng thái thanh toán
        if ($data['returncode'] === 1) {
            return [
                'returncode' => 1,
                'returnmessage' => 'Giao dịch thành công.',
                'data' => $data
            ];
        } else {
            return [
                'returncode' => 0,
                'returnmessage' => 'Giao dịch thất bại.',
                'data' => $data
            ];
        }
    }

/**
     * Truy vấn trạng thái thanh toán từ ZaloPay
     */
/*     public function getPaymentStatus($apptransid)
    {
        $data = $this->appId . '|' . $apptransid . '|' . $this->key1; // appid|apptransid|key1

        $mac = hash_hmac('sha256', $data, $this->key1);

        $params = [
            'appid' => $this->appId,
            'apptransid' => $apptransid,
            'mac' => $mac
        ];

        // Gửi yêu cầu API từ ZaloPay
        $response = Http::get($this->endpoint, $params);

        return $response->json();
    } */

    
}

