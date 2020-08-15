<?php

namespace App\Core\Database;

class QueryBuilder
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllDesc($table) //getting all in descending order (from most recently added)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} ORDER BY id DESC");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAll($table) //to get all in the normal order
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table}");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getOne($table, $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE id='{$id}'");

        $query->execute();

        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function getOneAssoc($table, $id) //function added so that line 155 on this page could work (stdClass cannot be used)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE id='{$id}'");

        $query->execute();

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getOneByField($table, $parameters)
    {

        $params = '';
        foreach($parameters as $key => $parameter) {
            $params.= "$key = '$parameter' AND ";
        }
        $params = substr($params, 0, -5);

        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$params}");


        $query->execute();

        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function insert($table, $data)
    {

        //handling image upload for new item. Only will execute is there is a $_FILES['img'] set
        if(isset($_FILES['img'])){
            if($_FILES['img']['tmp_name'] != '' OR $_FILES['img']['name'] != ''){

                if($_FILES['img']['type'] == 'image/jpeg'
                    OR $_FILES['img']['type'] == 'image/png'
                    OR $_FILES['img']['type'] == 'image/jpg'){

                    $uploadDir = getcwd()."\\public\\item-images";

                    $imageName = "chippie-item-".time().$_FILES['img']['name'];

                    //inserting into PHP admin section
                    move_uploaded_file($_FILES['img']['tmp_name'],$uploadDir."\\".$imageName);

                    $data['img'] = $imageName;
                }
            }
        }
        //notice: undefined;
        if(isset($data['password'])){
            $data['password'] = md5($data['password']); //pojacaj ovo ovde isto
        }

//        if(isset($data['date'])){ //sta cemo sa ovim ?
//            $data['date'] = "CURRENT_DATE()";
//            $data['time'] = "CURRENT_TIMESTAMP()";
////            INSERT INTO orders (NAME,total,address,email,phone,DATE,TIME) VALUES('Sir',12,'nice street','awesome@gmail.com',111,CURRENT_DATE,CURRENT_TIMESTAMP)
//        }

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(", " , array_keys($data)),
            ":" . implode(", :" , array_keys($data)));

        $query = $this->pdo->prepare($sql);

        $query->execute($data);

    }

    public function update($table, $data)
    {
        //handling image upload. Only executed when new image is selected
        if($_FILES['img']['tmp_name'] != '' OR $_FILES['img']['name'] != ''){

            if($_FILES['img']['type'] == 'image/jpeg'
                OR $_FILES['img']['type'] == 'image/png'
                OR $_FILES['img']['type'] == 'image/jpg') {

                $uploadDir = getcwd() . "\\public\\item-images";

                $newImageName = "chippie-item-" . time() . $_FILES['img']['name'];

                //inserting image into PHP directory and preparing to add to database table
                move_uploaded_file($_FILES['img']['tmp_name'], $uploadDir . "\\" . $newImageName);
                $data['img'] = $newImageName;

                //deleting the replaced image
                if(is_file($uploadDir."\\".$data['oldImageName'])){
                    unlink($uploadDir."\\".$data['oldImageName']);
                };

                echo "<pre>";
                var_dump($data);
                var_dump($_FILES['img']);
                //here, perform the transfer of this image into the image location.
                echo "</pre>";

            }
        }

        unset($data['oldImageName']);
        $id = $data['id'];
        unset($data['id']);

        $preparedParams = array_map(function($item) {
            return $item . "=:" . $item;
        }, array_keys($data));

        $sql = sprintf("UPDATE %s SET %s WHERE id = '%s'",
            $table,
            implode(', ', $preparedParams),
            $id);


        $query = $this->pdo->prepare($sql);

        $query->execute($data);

    }

    public function delete($table, $item)
    {
        if(isset($item['img'])){
            if(is_file(getcwd()."\\public\\item-images\\".$item['img'])){
                unlink(getcwd()."\\public\\item-images\\".$item['img']);
            }
        }

        // DELETE FROM table WHERE id
        $sql = sprintf("DELETE FROM %s WHERE id='%s'",
            $table,
            $item['id']);

        $query = $this->pdo->prepare($sql);
        $query->execute();
    }
}

