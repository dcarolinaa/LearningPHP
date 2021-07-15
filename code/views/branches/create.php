<h1 class="h3 mb-3"><b><?php echo $company->getName()?></b> / Nueva Sucursal </h1>
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
