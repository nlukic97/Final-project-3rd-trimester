<?php
namespace App\Controllers;
use App\Core\App;

class ApiItemsController {

    public function index()
    {
        //$user = api_check_auth();
        $items = App::get('database')->getAll('items');
        echo json_encode($items);
    }


    public function store()
    {
        //$user = api_check_auth(); //ovde nesto ne radi
        $orderData = json_decode(file_get_contents('php://input'), ARRAY_FILTER_USE_KEY);

        //validation and sanitization
            //name
            $orderData['orderInfo']['name'] = filter_var($orderData['orderInfo']['name'], FILTER_SANITIZE_STRING);

            //address
            $orderData['orderInfo']['address'] = filter_var($orderData['orderInfo']['address'], FILTER_SANITIZE_STRING);

            //email
            $email = filter_var($orderData['orderInfo']['email'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                $orderData['orderInfo']['email'] = $email;
            } else {
                $orderData['orderInfo']['email'] = '';
            }

            //phone
            $phone = filter_var($orderData['orderInfo']['phone'], FILTER_SANITIZE_NUMBER_INT);
            if(filter_var($phone, FILTER_VALIDATE_INT)){
                $orderData['orderInfo']['phone'] = $phone;
            } else {
                $orderData['orderInfo']['phone'] = '';
            }
            //total
            $orderData['orderInfo']['total'] = filter_var($orderData['orderInfo']['total'], FILTER_SANITIZE_STRING);

            //date
            $orderData['orderInfo']['date'] = filter_var($orderData['orderInfo']['date'], FILTER_SANITIZE_STRING);

            //time
            $orderData['orderInfo']['time'] = filter_var($orderData['orderInfo']['time'], FILTER_SANITIZE_STRING);


        App::get('database')->insert('orders', $orderData['orderInfo']);

        $recentId = App::get('database')->getLastInsertedId();

        $cart = $orderData['cartInfo']['cart'];

        foreach ($cart as $item){

            $item['order_id'] = $recentId;

            App::get('database')->insert('item_order',$item);
        }


        return [
            'status' => 'ok'
        ];
    }

    public function show()
    {
        $post = App::get('database')->getOne('items', $_GET['id']);

        echo json_encode($post);
    }

    public function update() //ne treba
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