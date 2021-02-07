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
        <?php
        foreach($frutitasArr as $index => $frutita){
            printf('<li> %2$s - %1$s </li>',$frutita,$index);
        }
        ?>
    </ul>
</body>
</html>

