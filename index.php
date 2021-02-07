<?php

$frutitas = 'Frambuesa con gusanos, Mango, Fresa, Manzana, Uva';

$frutitasArr = explode(', ',$frutitas);

?>
<html>
<header> 
</header>
<body>
    <h1>Frutitas</h1>
    <ul> 
        <?php foreach($frutitasArr as $frutita): ?>
            <li> <?=$frutita?> </li>
        <?php endforeach ?>
    </ul>
</body>
</html>

