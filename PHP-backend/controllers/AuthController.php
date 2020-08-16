<?php

namespace App\Controllers;

use App\Core\App;

class AuthController {

    public function login_form() {
        return view('login');
    }

    public function login()
    {
        //validacija

        $pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        unset($_POST['password']);

        $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

          return redirect('/login');

        }



        $user = App::get('database')->getOneByField('users', $_POST);


        if(!$user) {
            return redirect('/login');
        }

        //password check
        $full_salt = substr($user->password,0,29);

        $inputPass = crypt($pass,$full_salt);

        if($inputPass != $user->password){
            return redirect('/login');

        }

        $_SESSION['user'] = $user;

        return redirect('/');
    }

    public function register_form(){
        return view('register');
    }

    public function register()
    {
        if($_POST['password'] != $_POST['password_confirmation'] || !$_POST['password']) {
            return redirect('/register');
        }
        unset($_POST['password_confirmation']);
        $_POST['password'] = md5($_POST['password']);

        App::get('database')->insert('users', $_POST);

        dd('Replace this with rederict to protected area of your web app');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        return redirect('/');
    }
}