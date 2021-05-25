<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Mail; //追記
// use App\Mail\RegisterMail;

use Illuminate\Http\Request;
use Mail;
class RegisterController extends Controller
{
    // 入力画面表示
    public function index() {
        return view('registers.index');
    }

    // 送信ボタン押下時に呼ばれる
    public function register(Request $request) {
      $name = "LeBron James";

      // Mail::send(new RegisterMail($name));
      Mail::send('emails.test', $name, function($message){
        $message->to('pogbakami@icloud.com', 'Test')
        // $message->to('ago.kilon@gmail.com', 'Test')
        ->subject('This is a test mail');
      });
      
    }
}