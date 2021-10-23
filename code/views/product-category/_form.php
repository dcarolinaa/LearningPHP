<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $company->getId(); ?>" />
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Categoria:</label>
            <input class="form-control form-control-lg"
                value="<?php echo $category->getName(); ?>"
                type="text"
                name="name"
                placeholder="Nombre">
        </div>
        <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">
            <button type="submit" class="btn btn-lg btn-primary me-2"><?php echo $callAction; ?></button>
            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/categorias-de-productos" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</form>
