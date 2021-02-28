<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    var_dump($_GET);
    $id = $_GET['id'];

    $select = "Select * from countries where id = :id";
    $result = $mbd->prepare($select);
    $result->execute([
        ':id' => $id
    ]);


    $country = $result->fetch(PDO::FETCH_ASSOC);//sólo trae un elemento :3
    print_r($country);

    /*
        $result = $mbd->query('Select * from countries');
        //print_r($result->fetchAll(PDO::FETCH_COLUMN,1)); //Obtiene la columna especificada
        $countries = $result->fetchAll(PDO::FETCH_ASSOC);

        $delete = "Delete from countries where id = :id";
        $deleteStatement = $mbd->prepare($delete);
        $deleteStatement->execute([
            ':id'=>$id
        ]);

    */
      
?>
<html>
    <head>
    </head>
    <body>
        <h1> Edit Country </h1>
        <div>
            <form action="editCountry.php" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div>
                    <label for="name"> Name:</label>
                    <input type="text" id="name" name="name" value="<?= $country['name'] ?>">
                </div>
                <div>
                    <label for="code"> Code:</label>
                    <input type="text" id="code" name="code" value="<?= $country['code'] ?>">
                </div>
                <button type="submit">Send</button>
                <button type="reset">Clear</button>
            </form>
        </div>
    </body>
</html>