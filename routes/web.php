<?php

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', 'Controller@greet');

$router->post('/signup', 'AuthController@signUp');
$router->post('/signin', 'AuthController@signIn');

$router->post('/stock', ['middleware' => 'auth', 'uses' => 'StockController@store']);
$router->post('/stock-data/{id}', ['middleware' => 'auth', 'uses' => 'StockController@show']);
$router->post('/stocks', ['middleware' => 'auth', 'uses' => 'StockController@index']);
$router->post('/entry', ['middleware' => 'auth', 'uses' => 'EntryController@store']);
$router->post('/entry-sell', ['middleware' => 'auth', 'uses' => 'EntryController@delete']);
