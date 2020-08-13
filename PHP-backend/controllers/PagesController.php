<?php
namespace App\Controllers;


use App\Core\App;

class PagesController {
    public function home() //redirect to items, since there is no specific home page
    {
        redirect("/items");
    }

    public function items()
    {
        check_auth();
        $items = App::get('database')->getAll('items'); //ovaj treba da ne bude descenging. Orders treba

        return view('items', compact('items'));
    }

    public function orders()
    {
        check_auth();
        $orders = App::get('database')->getAllDesc('orders');
        return view('orders', compact('orders'));
    }

    public function contact()
    {

        return view('contact');
    }

    public function contactFormSubmit()
    {
        App::get('database')->insert('messages', [
            'subject' => $_POST['subject'],
            'message' => $_POST['message']
        ]);

        return redirect('/');

    }

}