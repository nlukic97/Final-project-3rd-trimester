<?php
namespace App\Controllers;
use App\Core\App;

class ApiFaqController
{
    public function index()
    {
//        $user = api_check_auth(); //sa ovom linijom koda ti ne stizu podaci
        $faq = App::get('database')->getAll('faq');
        echo json_encode($faq);
    }


    public function store() //ne treba
    {

        //uraditi prethodno sanitizaciju i validaciju !
        App::get('database')->insert('posts', $_POST);
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