<?php
namespace App\Controllers;
use App\Core\App;

class itemsController {

    public function index()
    {
        $items = App::get('database')->getAll('items'); //ovaj treba da ne bude descenging. Orders treba

        return view('items', compact('items'));
    }

    public function create()
    {
        return view('items-create');
    }

    public function store()
    {
        //uraditi prethodno sanitizaciju i validaciju !
        App::get('database')->insert('items', $_POST);

        return redirect('/items');
    }

    public function show()
    {
        $post = App::get('database')->getOne('items', $_GET['id']);

        return view('posts-show', compact('post'));
    }

    public function edit()
    {
        $item = App::get('database')->getOne('items', $_GET['id']);

        return view('items-edit', compact('item'));
    }

    public function update()
    {
        App::get('database')->update('items', $_POST);

        return redirect('/items');
    }

    public function destroy()
    {
        //getting all the info on the item, not just id. We will need the img name to be able to delete
        //it from our directory. This change has also affected the destroy method in the "usersController.php" file
        $item = App::get('database')->getOneAssoc('items', $_GET['id']);

        App::get('database')->delete('items', $item);

        return redirect('/items');

    }
    
}