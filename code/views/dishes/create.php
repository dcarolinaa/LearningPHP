<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Nuevo Producto'
    ], true);
    ?>
<div class="card">
    
    <div class="card-body">
    <?php
    echo $this->view('dishes/_form', [
            'action' => sprintf('/mis-negocios/%s/productos/store', $company->getSlug()),
            'company' => $company,
            'dish' => $dish,
            'callAction' => 'Crear',
            'errors' => $errors
        ], true);
    ?>
    </div>
</div>