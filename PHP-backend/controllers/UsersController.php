<?php
namespace App\Controllers;
use App\Core\App;

class   UsersController {

    public function index()
    {
        check_auth();
        $users = App::get('database')->getAll('users');

        return view('users-index', compact('users'));
    }

    public function create()
    {
        check_auth();
        return view('users-create');
    }

    public function store()
    {
        //uraditi prethodno sanitizaciju i validaciju !
        check_auth();

        if(isset($_POST['password'])){
            $_POST['password'] = md5($_POST['password']); //pojacaj ovo ovde isto
        }

        App::get('database')->insert('users', $_POST);

        return redirect('/users');
    }

    public function show()
    {
        check_auth();
        $user = App::get('database')->getOne('users', $_GET['id']);

        return view('users-show', compact('user'));
    }

    public function edit()
    {
        check_auth();
        $user = App::get('database')->getOne('users', $_GET['id']);

        return view('users-edit-name-email', compact('user'));
    }

    public function editPassword()
    {
        check_auth();
        $user = App::get('database')->getOne('users', $_GET['id']);

        return view('users-edit-password', compact('user'));
    }

    public function update()
    {
        //uraditi validaciju
        check_auth();
        $user = App::get('database')->getOneAssoc('users', $_POST['id']);

        if($user['password'] == md5($_POST['password'])){

            unset($_POST['password']);

            App::get('database')->update('users', $_POST);

        }

        return redirect('/users');
    }

    public function updatePassword()
    {
        //uraditi validaciju
        check_auth();
        var_dump($_POST);

        $user = App::get('database')->getOneAssoc('users', $_POST['id']);

        if($user['password'] == md5($_POST['currentPassword'])){

            unset($_POST['currentPassword']);
            $_POST['password'] = md5($_POST['password']);

            App::get('database')->update('users', $_POST);

        }

        return redirect('/users');
    }

    public function destroy()
    {
        check_auth();
        $item = App::get('database')->getOneAssoc('users', $_GET['id']);
        App::get('database')->delete('users', $item);

        return redirect('/users');

    }

}