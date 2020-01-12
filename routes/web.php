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

$router->get('/', function () use ($router) {
    return view('index');
});

$router->get('/{any}', function () use ($router) {
    return view('index');
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('login', 'Auth\LoginController@login');
    $router->post('register', 'Auth\RegisterController@register');

    $router->get('todo', 'TodoController@index');
    $router->post('todo', 'TodoController@store');
});