<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InstallmentMail extends Mailable
{
    use SerializesModels;

    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this->view('email.register-installment')
                    ->with([
                        'name' => $this->content['name'],
                        'phone' => $this->content['phone'],
                        'product' => $this->content['product'],
                        'documents' => $this->content['documents'],
                        'steps' => $this->content['steps'],
                    ])
                    ->subject('Thông tin hồ sơ mua xe trả góp');
    }
}
