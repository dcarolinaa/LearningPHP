<?php
    $mbd = new PDO('mysql:host=localhost;dbname=karydb','root','toor');
    $preferencesArr=[];

    $result = $mbd->query('select * from preferences');
    $preferences = $result->fetchAll(PDO::FETCH_ASSOC);    
?>

<htlm>
    <head>
    </head>
    <body>
        <h1> Preferences List </h1>
        <a href="preferencesForm.php"> New preference </a>
        <table border="1">
            <tr>
                <th> Id </th>
                <th> Short Name </th>
                <th> Name </th>
                <th> Options </th>
            </tr>
            <?php foreach($preferences as $preference): ?>
                <tr>
                    <td>
                        <?= $preference['id'] ?>
                    </td>
                    <td>
                        <?= $preference['shortname'] ?>
                    </td>
                    <td>
                        <?= $preference['name'] ?>
                    </td>
                    <td>
                        <a href="preferenceEditForm.php?id=<?= $preference['id'] ?>"> Edit </a>
                        <a href="preferenceDelete.php?id=<?= $preference['id'] ?>"> Delete </a>                        
                    </td>                    
                </tr>
            <?php endforeach ?>           
        </table>

    </body>

</html>