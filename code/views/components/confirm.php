<h1 class="h3 mb-3"> <?php echo $title; ?> </h1>
<div class="row d-flex justify-content-center">
<div class="card col-6">    
    <div class="card-body">
        <div><?php echo $text; ?><div>
        <div class="mt-3 d-flex justify-content-end">        
            <a href="<?php echo $urlOk; ?>" class="btn btn-lg btn-<?php echo $okCss; ?> me-2"><?php echo $okText; ?></a>
            <a href="<?php echo $urlCancel; ?>" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</div>
</div>

