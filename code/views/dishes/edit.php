<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => sprintf('Editar %s', $dish->getName())
    ], true);
    ?>
<div class="card">
    <div class="card-body">
        <?php
        echo $this->view('dishes/_form', [
            'action' => sprintf(
                '/mis-negocios/%s/platillos/%s/update',
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