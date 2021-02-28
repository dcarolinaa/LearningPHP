<?php
    $mdb = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    $id = $_GET['id'];

    $delete = "Delete from preferences where id = :id";
    $deleteStatement = $mdb->prepare($delete);
    $deleteStatement->execute([
        ':id' => $id
    ]);

    header("Location:preferences.php");
?>