<?php
namespace App\Controllers;
use App\Core\App;

class itemsController {

    public function index()
    {
        check_auth();
        $items = App::get('database')->getAll('items'); //ovaj treba da ne bude descenging. Orders treba

        return view('items', compact('items'));
    }

    public function create()
    {
        check_auth();
        return view('items-create');
    }

    public function store()
    {
        //uraditi prethodno sanitizaciju i validaciju !
        check_auth();

        if(isset($_FILES['img'])){
            if($_FILES['img']['tmp_name'] != '' OR $_FILES['img']['name'] != ''){

                if($_FILES['img']['type'] == 'image/jpeg'
                    OR $_FILES['img']['type'] == 'image/png'
                    OR $_FILES['img']['type'] == 'image/jpg'){

                    $uploadDir = getcwd()."\\public\\item-images";

                    $imageName = "chippie-item-".time().$_FILES['img']['name'];

                    //inserting into PHP admin section
                    move_uploaded_file($_FILES['img']['tmp_name'],$uploadDir."\\".$imageName);

                    $_POST['img'] = $imageName;
                }
            }
        }

        App::get('database')->insert('items', $_POST);

        return redirect('/items');
    }

    public function show()
    {

        check_auth();
        $item = App::get('database')->getOne('items', $_GET['id']);

        return view('items-show', compact('item'));
    }

    public function edit()
    {
        check_auth();
        $item = App::get('database')->getOne('items', $_GET['id']);

        return view('items-edit', compact('item'));
    }

    public function update()
    {
        check_auth();

        //handling image upload. Only executed when new image is selected
        if($_FILES['img']['tmp_name'] != '' OR $_FILES['img']['name'] != ''){

            if($_FILES['img']['type'] == 'image/jpeg'
                OR $_FILES['img']['type'] == 'image/png'
                OR $_FILES['img']['type'] == 'image/jpg') {

                $uploadDir = getcwd() . "\\public\\item-images";

                $newImageName = "chippie-item-" . time() . $_FILES['img']['name'];

                //inserting image into PHP directory and preparing to add to database table
                move_uploaded_file($_FILES['img']['tmp_name'], $uploadDir . "\\" . $newImageName);
                $_POST['img'] = $newImageName;

                //deleting the replaced image
                if(is_file($uploadDir."\\".$_POST['oldImageName'])){
                    unlink($uploadDir."\\".$_POST['oldImageName']);
                }

            }
        }

        unset($_POST['oldImageName']);
        $id = $_POST['id'];
        unset($_POST['id']);

        echo "<pre>";
        var_dump($_POST);
        var_dump($_FILES['img']);
        echo "</pre>";
        die();

        App::get('database')->update('items', $_POST); //ovde ima neki problem. -------- kako da prosledim ID do update query funkcije ??

        return redirect('/items');
    }

    public function destroy()
    {
        check_auth();

        $item = App::get('database')->getOneAssoc('items', $_GET['id']);

        App::get('database')->delete('items', $item);

        return redirect('/items');

    }
    
}