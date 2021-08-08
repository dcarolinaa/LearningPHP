<h1 class="h3 mb-3">
    <a href="/mis-negocios/<?php echo $company->getSlug(); ?>"><b><?php echo $company->getName(); ?></b></a>
    / Editar Sucursal <?php echo $branch->getName(); ?> 
</h1>
<div class="card">    
    <div class="card-body">
        <?php
        echo $this->view('branches/_form', [
            'action' => sprintf('/mis-negocios/%s/sucursales/%s/update', $company->getId(), $branch->getId()),
            'callAction' => 'Guardar',
            'company' => $company,
            'googleApiKey' => $googleApiKey,
            'branch' => $branch,
            'errors' => $errors
        ], true);
        ?>
         
    </div>
</div>
