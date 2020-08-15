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

        $orderData = json_decode(file_get_contents('php://input'),ARRAY_FILTER_USE_KEY);
//        $orderInfo = $_POST;
//        var_dump($orderData);

        App::get('database')->insert('orders', $orderData['orderInfo']);

        $recentId = App::get('database')->getLastInsertedId();

//        echo $recentId;
//        var_dump($orderData);
        $cart = $orderData['cartInfo']['cart'];
//        var_dump($cart);
        echo "<pre>";
        foreach ($cart as $item){
            $item['order_id'] = $recentId;#
            App::get('database')->insert('item_order',$item);
            var_dump($item);
        }
        echo "</pre>";

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