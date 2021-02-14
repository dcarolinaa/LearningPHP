<?php

    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    $countriesArr=[];
    $result = $mbd->query('Select * from countries');
    //print_r($result->fetchAll(PDO::FETCH_COLUMN,1)); //Obtiene la columna especificada
    $countries = $result->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result->fetchAll(PDO::FETCH_OBJ));

   

?>
<htlm>
    <head>
    </head>
    <body>
        <h1> Countries List </h1>
        <a href="countries_form.php"> New country </a>
        <table border="1">
            <tr>
                <th> Id </th>
                <th> Name </th>
                <th> Code </th>
                <th> Options </th>
            </tr>
            <?php foreach($countries as $country): ?>
                <tr>
                    <td>
                        <?= $country['id'] ?>
                    </td>
                    <td>
                        <?= $country['name'] ?>
                    </td>
                    <td>
                        <?= $country['code'] ?>
                    </td>
                    <td>
                        <a href="countryEdit.php?id=<?= $country['id'] ?>"> Edit </a>
                        <a href="countryDelete.php?id=<?= $country['id'] ?>"> Delete </a>                        
                    </td>                    
                </tr>
            <?php endforeach ?>           
        </table>

    </body>

</html>