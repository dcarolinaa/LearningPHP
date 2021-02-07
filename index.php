<?php

$frutitas = 'Frambuesa con gusanos, Mango, Fresa, Manzana, Uva';

$frutitasArr = explode(', ',$frutitas);

$frutitasArr[] = "Mandarina";
$frutitasArr[] = "Naranja";
$frutitasArr[] = "Guayaba";

?>
<html>
<header> 
</header>
<body>
    <h1>Frutitas</h1>
    <ul> 
        <?php foreach($frutitasArr as $frutita): ?>
            <li> <?=ucwords($frutita)?> </li>
        <?php endforeach ?>
    </ul>
    <?=implode(', ',$frutitasArr)?>
    <hr>
    <?=md5("carolina2021")?>

</body>
</html>

