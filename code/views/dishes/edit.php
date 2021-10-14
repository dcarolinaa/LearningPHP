<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => sprintf('Editar %s', $dish->getName())
    ], true);
    ?>
<div class="card">
    <div class="card-header">
        <a href="/mis-negocios/<?php echo $company->getSlug();?>/categorias-de-productos" id="btn-new"> Categorias </a>
    </div>
    <div class="card-body">
        <?php
        echo $this->view('dishes/_form', [
            'action' => sprintf(
                '/mis-negocios/%s/productos/%s/update',
                $company->getSlug(),
                $dish->getId()
            ),
            'company' => $company,
            'dish' => $dish,
            'callAction' => 'Actualizar',
            'errors' => $errors
        ], true);
        ?>
    </div>
</div>