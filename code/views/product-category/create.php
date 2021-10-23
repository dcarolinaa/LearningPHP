<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Nueva Categoria De Producto'
    ], true);
    ?>
<div class="card">
    <div class="card-body">
    <?php
    echo $this->view('product-category/_form', [
            'action' => sprintf('/mis-negocios/%s/categorias-de-productos/store', $company->getSlug()),
            'company' => $company,
            'category' => $category,
            'callAction' => 'Crear',
            'errors' => $errors
        ], true);
    ?>
    </div>
</div>