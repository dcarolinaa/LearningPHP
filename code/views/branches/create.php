<a href="/mis-negocios/<?php echo $company->getId()?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName()?></h1>
</a>

<h1 class="h3 mb-3">
    Nueva Sucursal
</h1>
<div class="card">
    <div class="card-body">
        <?php echo $this->view('branches/_form', [
            'action' => sprintf('/mis-negocios/%s/sucursales/store', $company->getId()),
            'company' => $company,
            'callAction' => 'Crear',
            'googleApiKey' => $googleApiKey
        ], true);?> 
    </div>
</div>
