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


$router -> group(['prefix' => 'api'],function()use($router) {
  $router -> get('/product', 'ProductController@showAll');

  $router -> get('/product/{id}', 'ProductController@showOne');

  $router -> post('/product', 'ProductController@create');

  $router -> delete('/product/{id}', 'ProductController@delete');

  $router -> put('/product/{id}', 'ProductController@update');

  $router -> get('/product/findByName/{name}', 'ProductController@showName');

  $router -> delete('/product', 'ProductController@deleteAll');
});