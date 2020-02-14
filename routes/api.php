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
    return 'Authors Service.';
});

$router->get('/authors', 'AuthorsController@index');
$router->get('/authors/{uuid}', 'AuthorsController@show');
$router->post('/authors', 'AuthorsController@create');
$router->put('/authors/{uuid}', 'AuthorsController@update');
$router->patch('/authors/{uuid}', 'AuthorsController@update');
$router->delete('/authors/{uuid}', 'AuthorsController@destroy');