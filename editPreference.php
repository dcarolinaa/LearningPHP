<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
        
    $update = 'update preferences set shortname = :shortname, name = :name where id = :id';
    
    $statement = $mbd->prepare($update);
    $var = $statement->execute([
        ':shortname' => $_POST['shortName'], 
        ':name' => $_POST['name'],
        ':id' => $_POST['id']
    ]);

    if($var===false){
        print_r($statement->errorInfo());
    }else{
        header("Location:preferences.php");
    }    
?>