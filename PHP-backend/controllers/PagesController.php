<?php
namespace App\Controllers;


use App\Core\App;

class PagesController {
    public function home() //redirect to orders, since there is no specific home page
    {
        check_auth();
        redirect("/orders");
    }

    public function orders()
    {
        check_auth();
        $orders = App::get('database')->getAllDesc('orders');

        $item_orders = App::get('database')->getAll('item_order'); // ??? kako ovo da upakujem u text ?

        return view('orders', compact('orders','item_orders'));
    }

    public function error404()
    {
        check_auth();

        return view('404');
    }

}