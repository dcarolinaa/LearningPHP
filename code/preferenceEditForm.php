<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    $id = $_GET['id'];

    $select = "Select * from preferences where id = :id";
    $resultStatement = $mbd->prepare($select);
    $resultStatement->execute([
        ':id' => $id
    ]);

    $preference = $resultStatement->fetch(PDO::FETCH_ASSOC);
?>

<html>
    <head>
    </head>
    <body>
        <h1> Edit Preference </h1>
        <div>
        <form action="editPreference.php" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div>
                    <label for="shortName"> Short Name:</label>
                    <input type="text" id="shortName" name="shortName" value="<?= $preference['shortname'] ?>">
                </div>
                <div>
                    <label for="name"> Name: :</label>
                    <input type="text" id="name" name="name" value="<?= $preference['name'] ?>">
                </div>
                <button type="submit">Send</button>
                <button type="reset">Clear</button>
            </form>
        </div>
    </body>
</html>