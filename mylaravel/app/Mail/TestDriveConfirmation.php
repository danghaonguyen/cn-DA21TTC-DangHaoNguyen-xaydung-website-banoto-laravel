<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestDriveConfirmation extends Mailable
{

    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $formattedDate; // date
    public $formattedTime; // time
    public $location;
    public $productName;

    public function __construct($name, $email, $formattedDate, $formattedTime, $location, $productName)
    {
        $this->name = $name;
        $this->email = $email;
        $this->formattedDate = $formattedDate; // date - định dạng (dd/mm/yy)
        $this->formattedTime = $formattedTime; // time - định dạng AM or PM
        $this->location = $location;
        $this->productName = $productName; // Truyền tên sản phẩm
    }

    public function build()
    {
        return $this->view('email.register-test')
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'date' => $this->formattedDate,
                        'time' => $this->formattedTime,
                        'location' => $this->location,
                        'productName' => $this->productName, // Truyền tên sản phẩm vào view
                    ])
                    ->subject('Xác Nhận Lịch Lái Thử');
    }
}