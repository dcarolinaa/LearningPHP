<h1 class="h3 mb-3"><b><?php echo $company->getName()?></b> / Editar Sucursal <?php echo $i?> </h1>
<div class="card">    
    <div class="card-body">
        <?php echo $this->view('branches/_form', [
            'action' => sprintf('/mis-negocios/%s/sucursales/%s/update', $company->getId(), $i),
            'callAction' => 'Guardar',
            'company' => $company,
            'googleApiKey' => $googleApiKey,
            'i' => $i
        ], true);?> 
    </div>
</div>
