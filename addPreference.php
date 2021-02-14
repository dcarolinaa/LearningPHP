<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');

    $insert = 'Insert into preferences(name, shortname) values(:name, :shortname)';

    $insertStatement = $mbd->prepare($insert);
    $insertStatement->execute([
        ':name' => $_POST['name'],
        ':shortname' => $_POST['shortName']
    ]);

    header("Location:preferences.php");
?>