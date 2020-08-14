<?php
namespace App\Controllers;
use App\Core\App;

class ApiItemsController {

    public function index()
    {
//        $user = api_check_auth(); //sa ovom linijom koda ti ne stizu podaci
        $items = App::get('database')->getAll('items');
        echo json_encode($items);
    }


    public function store()
    {

        //uraditi prethodno sanitizaciju i validaciju !
//        var_dump($_REQUEST);
//        echo json_encode(['name' => 'Vlada', 'lastname' =>'Bla'], JSON_FORCE_OBJECT);

        //forEach na Post['items'] i da ubacujes u bazu jedan po jedan
        $orderInfo = json_decode(file_get_contents('php://input'),ARRAY_FILTER_USE_KEY);
//        $orderInfo = $_POST;
        var_dump($orderInfo['orderInfo']);
        App::get('database')->insert('orders', $orderInfo['orderInfo']);
        die();

        App::get('database')->insert('orders', $_POST);
        return [
            'status' => 'ok'
        ];
    }

    public function show()
    {
        $post = App::get('database')->getOne('items', $_GET['id']);

        echo json_encode($post);
    }

    public function update()
    {
        //uraditi validaciju
        App::get('database')->update('posts', $_POST);
        return [
            'status' => 'ok'
        ];
    }

    public function destroy()
    {
        App::get('database')->delete('posts', $_GET['id']);

        return [
            'status' => 'ok'
        ];

    }

}