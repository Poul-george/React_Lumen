<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->to('pogbakami@icloud.com')  // 送信先アドレス
      ->subject('登録完了しました。')// 件名
      ->view('registers.register_mail')// 本文
      ->with(['name' => $this->name]); // 本文に送る値
    }
}