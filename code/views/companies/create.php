<h1 class="h3 mb-3"> Nuevo Negocios </h1>
<div class="card">    
    <div class="card-body">
        <?php echo $this->view('companies/_form', [
            'action' => '/mis-negocios/store'
        ], true);?> 
    </div>
</div>
