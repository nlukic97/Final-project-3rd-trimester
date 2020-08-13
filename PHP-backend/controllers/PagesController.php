<?php
namespace App\Controllers;


use App\Core\App;

class PagesController {
    public function home() //redirect to orders, since there is no specific home page
    {
        check_auth();
        redirect("/orders");
    }

    public function items()
    {
        check_auth();
        $items = App::get('database')->getAll('items');

        return view('items', compact('items'));
    }

    public function orders()
    {
        check_auth();
        $orders = App::get('database')->getAllDesc('orders');
        return view('orders', compact('orders'));
    }

    public function users()
    {
        check_auth();
        $users = App::get('database')->getAll('users');
        return view('users', compact('users'));
    }

}