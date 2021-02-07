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
        foreach($frutitasArr as $frutita){            
            //echo sprintf('<li> %s </li>',$frutita);
            printf('<li> %s </li>',$frutita);
        }
        ?>
    </ul>
</body>
</html>

