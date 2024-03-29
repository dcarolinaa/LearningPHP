<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Nuevo Producto'
    ], true);
    ?>
<div class="card">
    <?php
    echo $this->view('products/_sub-menu', ['company' => $company], true)
    ?>
    <div class="card-body">
    <?php
    echo $this->view('products/_form', [
            'action' => sprintf('/mis-negocios/%s/productos/store', $company->getSlug()),
            'company' => $company,
            'product' => $product,
            'callAction' => 'Crear',
            'errors' => $errors
        ], true);
    ?>
    </div>
</div>