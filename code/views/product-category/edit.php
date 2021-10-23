<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Edicion de Categoria de Producto'
    ], true);
    ?>
<div class="card">
    <div class="card-body">
    <?php
    echo $this->view('product-category/_form', [
            'action' => sprintf('/mis-negocios/%s/categorias-de-productos/update', $company->getSlug()),
            'company' => $company,
            'category' => $category,
            'callAction' => 'Actualizar',
            'errors' => $errors
        ], true);
    ?>
    </div>
</div>