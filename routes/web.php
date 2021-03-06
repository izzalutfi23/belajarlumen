<?php

// use App\Http\Controllers\Postcontroller;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// $router->get('/posts', [Postcontroller::class, 'index']);
$router->get('/posts', 'Postcontroller@index');
$router->post('/posts', 'Postcontroller@store');
$router->get('/posts/{id}', 'Postcontroller@show');
$router->put('/posts/{id}', 'Postcontroller@update');
$router->delete('/posts/{id}', 'Postcontroller@destroy');