<?php
//
//$router->register([
//    '' => 'controllers/index.php',
//    'about' => 'controllers/about.php',
//    'about/culture' => 'controllers/about.culture.php',
//    'contact' => 'controllers/contact.php',
//    'api/tasks' => 'controllers/api.tasks.php',
//    'contact-submit' => 'controllers/contact.submit.php'
//
//]);

//$routes = [
//    'GET' => ['' => 'controllers/index.php',
//        'about' => 'controllers/about.php',
//        'about/culture' => 'controllers/about.culture.php',
//        'contact' => 'controllers/contact.php',
//        'api/tasks' => 'controllers/api.tasks.php',
//    ],
//    'POST' => [
//        'contact-submit' => 'controllers/contact.submit.php'
//    ]
//];
//
$router->get('login', 'AuthController@login_form');
$router->post('login', 'AuthController@login');
$router->get('register', 'AuthController@register_form'); // !!!
$router->post('register', 'AuthController@register'); // !!!
$router->get('logout', 'AuthController@logout');

//pages
$router->get('', 'PagesController@home'); //redirects to items
$router->get('items', 'PagesController@items'); // ?????
$router->get('orders', 'PagesController@orders');

// ITEMS
//$router->get('items', 'itemsController@index'); // ????
$router->get('items/create', 'itemsController@create');
$router->post('items/create', 'itemsController@store');
$router->get('items/show', 'itemsController@show');
$router->get('items/edit', 'itemsController@edit');
$router->post('items/edit', 'itemsController@update');
$router->get('items/destroy', 'itemsController@destroy');


//API ORDERS
$router->get('api/items', 'ApiPostsController@index');
$router->post('api/items', 'ApiPostsController@store');
//$router->get('api/items/show', 'ApiPostsController@show');
//$router->post('api/items/edit', 'ApiPostsController@update');
//$router->get('api/items/destroy', 'ApiPostsController@destroy');


//USERS
$router->get('users', 'UsersController@index');
$router->get('users/create', 'UsersController@create');
$router->post('users', 'UsersController@store');
$router->get('users/show', 'UsersController@show');
$router->get('users/edit', 'UsersController@edit');
$router->post('users/edit', 'UsersController@update');
$router->get('users/destroy', 'UsersController@destroy');



//$router->post('ovo/je/ruta', 'OvoJeKontroler@metodUKontroleru');