<?php

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

//一覧画面
// $router->get('/', 'PostController@showList');

// $router->get('/', 'PostController@showList')->name('blogs');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$route->get('/say/{what}', function($what){
    return "You say: " . $what;
});