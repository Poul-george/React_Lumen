<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Mailer;
use App\Http\Controllers\RegisterController;

/** @var \Laravel\Lumen\Routing\Router $router */ 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


//メール送信機能    ///////
$router->post('/mail_limen', 'RegisterController@register');




////////react lumen 
//post test
$router->post('/post_test', 'PostController@postTest');
//ブログ登録test
$router->post('/test', 'PostController@testStore');
//ブログ表示
$router->get('/pos', 'PostController@jsonList');
//ブログ削除
$router->post('/delete/{id}', 'PostController@exeDestroy');





//メール

// $router->post('/mail_post', 'UserController@mailPost');



// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

//ログイン画面
$router->get('/sign_up', 'UserController@loginPage');
$router->post('/user_judge', 'UserController@UserJudge');
//ユーザー仮登録（新規登録）
$router->post('/new_user', 'UserController@newUser');
//ユーザー仮登録（メール送信）
// $router->get('/mail_post', 'UserController@mailPost');
$router->post('/mail_post', 'UserController@mailPost');




//ブログ表示
    $router->get('/', 'PostController@showList');
    $router->get('/pos', 'PostController@jsonList');
    $router->get('/json_test', 'TestController@jsonTest');
//ブログ作成
$router->get('/form', 'PostController@showCreate');
//ブログ登録
$router->post('/create', 'PostController@exeStore');

//ブログ登録
$router->get('/image_post', 'PostController@imageStore');

//ブログ詳細
$router->get('/{id}', 'PostController@showDetail');

// $router->get('/delete', 'PostController@exeDestroy');
//ブログ編集画面
$router->post('/edit/{id}', 'PostController@showEdit');
$router->post('/editItem/{id}', 'PostController@itemEdit');
//ブログUpfate
$router->post('/update', 'PostController@exeUpdate');

