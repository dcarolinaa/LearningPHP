<?php
    $imageUrl = $dish->getId() ? sprintf('/imagenes/%s/platillos/platillo-%s_w300v%s.jpg',
            $company->getSlug(),
            $dish->getId(),
            (new \DateTime($company->getUpdate_date()))->format('U')
        ) : '';
    ?>
<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $dish->getId(); ?>" />
    <input type="hidden" name="id_company" value="<?php echo $company->getId(); ?>" />
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Nombre:</label>
            <input class="form-control form-control-lg" value="<?php echo $dish->getName(); ?>" type="text" name="name" placeholder="Nombre">
            <?php echo $this->view('errors', ['attribute' => 'name', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Descripción:</label>
            <textarea class="form-control form-control-lg" name="description" placeholder="Descripción"><?php echo $dish->getDescription(); ?></textarea>
            <?php echo $this->view('errors', ['attribute' => 'description', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Categiria:</label>
            <select class="form-control" name="category">
                <option>A</option>
                <option>B</option>
                <option>C</option>
            </select>
            <?php echo $this->view('errors', ['attribute' => 'category', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Foto:</label>
            <?php if ($dish->getId()) : ?>
                <div><img src="<?php echo $imageUrl; ?>" width="300" class="mb-3"/></div>
            <?php endif ?>
            <input class="form-control form-control-lg" type="file" name="image">
        </div>
        <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">        
            <button type="submit" class="btn btn-lg btn-primary me-2"><?php echo $callAction; ?></button>
            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/productos" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</form>