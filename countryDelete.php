<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');

    $id = $_GET['id'];

    $delete = "Delete from countries where id = :id";
    $deleteStatement = $mbd->prepare($delete);
    $deleteStatement->execute([
        ':id'=>$id
    ]);

    header("Location:countries.php");

    /*
        $statement = $mbd->prepare($insert);
        $statement->execute(array(':name' => $_POST['name'], ':code'=>$_POST['code']));
    */
?>