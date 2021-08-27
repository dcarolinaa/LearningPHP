<?php
    echo $this->view('components/title', [
        'company' => $company,
        'title' => 'Nuevo Platillo'
    ], true);
?>
<div class="card">
    <div class="card-body">
        <?php echo $this->view('dishes/_form', [
            'action' => '/mis-negocios/store',
            'company' => $company,
            'callAction' => 'Crear'
        ], true);?> 
    </div>
</div>