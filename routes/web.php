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


// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->get('product', 'ProductController@allProducts');
    $router->get('product/{id}', 'ProductController@singleProduct');

    $router->post('product', 'ProductController@insertProduct');
    $router->post('product/{id}', 'ProductController@updateProduct');
    $router->put('product/{id}', 'ProductController@updateProduct');
    $router->patch('product/{id}', 'ProductController@updateProduct');
    $router->delete('product/{id}', 'ProductController@deleteProduct');

    $router->post('upImage', 'ImageController@index');

   
});