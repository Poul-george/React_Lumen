<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; //追記
use App\Mail\RegisterMail;

use App\Http\Controllers\Controller;
use App\Models\User;
use PHPMailer\PHPMailer;

//言語、内部エンコーディングを指定
mb_language("japanese");
mb_internal_encoding("UTF-8");


class UserController extends Controller
{
  //ログイン画面表示
  public function loginPage(Request $request) {
    $users = User::all();
    return view('log_in', ["users" => $users]);
  }
  //ログイン画面表示
  public function UserJudge(Request $request) {
    $users = User::all();
    return response()->json($users);
  }

  //ユーザー仮登録（新規登録）
  public function newUser(Request $request) {
    $user = new User;
    $user->user_id = $request[3];
    $user->user_name = $request[0];
    $user->email = $request[1];
    $user->dummy_judge = $request[4];
    $user->password = $request[2];
    $user->created_at = date("Y/m/d H:i:s");
    $user->save();
    return redirect('sign_up');
    return response()->json($request);
  }

  //確認メール送信
  public function mailPost() {
    $lll = [1,2,3,4,5];
    $mail = new PHPMailer\PHPMailer();
    //日本語用設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "7bit";

    $mail->isSMTP();   // SMTP を使用
    $mail->Host       = 'smtp.gmail.com';  // SMTP サーバーを指定
    $mail->SMTPAuth   = true;   // SMTP authentication を有効に
    $mail->Username   = 'lebronkamisama@gmail.com';  // SMTP ユーザ名
    $mail->Password   = 'hdoxoljsshqtqcuk';  // SMTP パスワード
    $mail->SMTPSecure = 'tls';  // 暗号化を有効に
    $mail->Port       = 587;  // TCP ポートを指定


      //受信者設定 
      //※名前などに日本語を使う場合は文字エンコーディングを変換
      //差出人アドレス, 差出人名
      $mail->setFrom('lebronkamisama@gmail.com', mb_encode_mimeheader('test'));  
      //受信者アドレス, 受信者名（受信者名はオプション）
      $mail->addAddress('pogbakami@icloud.com', mb_encode_mimeheader("子分")); 
      //返信用アドレス（差出人以外に別途指定する場合）
      $mail->addReplyTo('lebronkamisama@gmail.com', mb_encode_mimeheader("お問い合わせ")); 
      //Cc 受信者の指定
      $mail->addCC('foo@example.com'); 
      
      //コンテンツ設定
      $mail->isHTML(true);   // HTML形式を指定
      //メール表題（文字エンコーディングを変換）
      $mail->Subject = mb_encode_mimeheader(''); 
      //HTML形式の本文（文字エンコーディングを変換）
      $mail->Body  = mb_convert_encoding('http://co-19-246.99sv-coco.com/LCC_IT/frontend/lcc_frontend1.php',"JIS","UTF-8");  
      //テキスト形式の本文（文字エンコーディングを変換）
      $mail->AltBody = mb_convert_encoding('DDDDDDDDDDDDDDDDDDDDD',"JIS","UTF-8"); 
    
      $mail->send();  //送信

    // if ($mail->send() === false) {
    //     echo "Mail sending failed!! Mailer Error: {$mail->ErrorInfo}";
    // }

    
    
    return response()->json($lll);
  }

  //ユーザー本登録＆ログイン
}