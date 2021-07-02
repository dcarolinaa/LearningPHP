<form action="<?php echo $action?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Nombre:</label>
            <input class="form-control form-control-lg" type="text" name="name" placeholder="Nombre">
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Logo:</label>
            <div><img src="/img/shushi-go.png" height="100" class="mb-3"/></div>
            <input class="form-control form-control-lg" type="file" name="logo">
        </div>
        <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">        
            <button type="submit" class="btn btn-lg btn-primary me-2">Crear</button>
            <a href="/mis-negocios" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</form>