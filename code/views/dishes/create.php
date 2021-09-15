<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Nuevo Platillo'
    ], true);
    ?>
<div class="card">
    <div class="card-body">
    <?php
    echo $this->view('dishes/_form', [
            'action' => sprintf('/mis-negocios/%s/platillos/store', $company->getSlug()),
            'company' => $company,
            'dish' => $dish,
            'callAction' => 'Crear',
            'errors' => $errors
        ], true);
    ?>
    </div>
</div>