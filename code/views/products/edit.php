<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => sprintf('Editar %s', $product->getName())
    ], true);
    ?>
<div class="card">
    <div class="card-header">
        <a href="/mis-negocios/<?php echo $company->getSlug();?>/categorias-de-productos" id="btn-new"> Categorias </a>
    </div>
    <div class="card-body">
        <?php
        echo $this->view('products/_form', [
            'action' => sprintf(
                '/mis-negocios/%s/productos/%s/update',
                $company->getSlug(),
                $product->getId()
            ),
            'company' => $company,
            'product' => $product,
            'callAction' => 'Actualizar',
            'errors' => $errors
        ], true);
        ?>
    </div>
</div>