<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    print_r($_POST['name']);

    $insert = 'Insert into countries(name,code) values(:name,:code)';
    
    $statement = $mbd->prepare($insert);
    $statement->execute([
        ':name' => $_POST['name'], 
        ':code' => $_POST['code']
    ]);

    header("Location:countries.php");
?>