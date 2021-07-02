<h1 class="h3 mb-3"> Editar Negocio </h1>
<div class="card">    
    <div class="card-body">
        <?php echo $this->view('companies/_form', [
            'action' => '/mis-negocios/update'
        ], true);?> 
    </div>
</div>
