<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    var_dump($_POST);
    
    $update = 'update countries set name = :name, code = :code where id = :id';
    
    $statement = $mbd->prepare($update);
    $var = $statement->execute([
        ':name' => $_POST['name'], 
        ':code' => $_POST['code'],
        ':id' => $_POST['id']
    ]);

    if($var===false){
        print_r($statement->errorInfo());
    }else{
        header("Location:countries.php");
    }
?>