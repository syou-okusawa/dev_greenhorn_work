<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\UserInfosRepository;
use App\Services\Classes\Cryptogram;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
      $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $user_name = $this->inputs['last_name'] . ' ' . $this->inputs['first_name'];
      $message = $this->inputs['message'];

      // ネットワーク上で個人情報を第三者に盗み見られないように暗号化
      $encoded_data = Cryptogram::easyEncryption($this->inputs);

      // 送信するデータを設定（message, user_id, user_name）
      $query_string = '?data=' . $encoded_data;

      // URLに設定したデータを付与
      $url = url('/');
      $data = [
          'url' => $url,
          'query_string' => $query_string,
          'user_name' => $user_name,
          'user_message' => $message
      ];
      return $this->view('mail.access_permission_email')->with($data);
    }
}
