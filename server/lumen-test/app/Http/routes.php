
<?php

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

use Illuminate\Support\Facades\Mail;

$app->get('/mail_post', function () {
//    return $app->welcome();
    Mail::raw('Raw string email', function($msg) { $msg->to(['pogbakami@icloud.com']); $msg->from(['pogbakami@icloud.com']); });

    return 'logged email via mailtrap.io...';

});

//Temporary route to generate key for .env file
$app->get('/key', function() {
    return str_random(32);
});