<?php
    $nuevaFruta = isset($_POST['frutita']) ? $_POST['frutita'] : "";

    if(isset($_POST['frutitas'])){
        $strFrutitas = $_POST['frutitas'];
    }else{
        $strFrutitas = '';
    }

    if($strFrutitas===""){
        $frutitas = [];
    }else{
        $frutitas = explode(',', $strFrutitas);
    }

    if($nuevaFruta!=''){
        $frutitas[]=$nuevaFruta;
        $strFrutitas = implode(',', $frutitas);
    }
    
?>


<html>
<header> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</header>
<body>
    <div class="container mt-4">

        <h1>Frutitas</h1><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <form action="index.php" method="POST" class="row g-3">
            <div class="col-12">
                <input type="text" name="frutita" class="form-control">
            </div>    
            <div class="col-12">
                <input type="submit" value="Agregar" class="btn btn-primary">
            </div>
            <input type="hidden" name="frutitas" value="<?=$strFrutitas?>"> 
        </form>
        <hr>
        <ul>
        <?php foreach($frutitas as $frutita):?>
            <li><?=$frutita?></li>
        <?php endforeach ?>
        </ul>
    </div>
</body>
</html>

