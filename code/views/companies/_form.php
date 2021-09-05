<?php
    $imageUrl = $company->getId() ? sprintf('/imagenes/negocios/logo-%s_w300v%s.jpg',
        $company->getSlug(),
        (new \DateTime($company->getUpdate_date()))->format('U')
    ) : '';
    ?>
<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $company->getId(); ?>" />
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Nombre:</label>
            <input class="form-control form-control-lg"
                value="<?php echo $company->getName(); ?>"
                type="text"
                name="name"
                placeholder="Nombre">
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Logo:</label>
            <?php if ($company->getId()) : ?>
                <div><img src="<?php echo $imageUrl; ?>" width="300" class="mb-3"/></div>
            <?php endif ?>
            <input class="form-control form-control-lg" type="file" name="logo">
        </div>
        <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">
            <button type="submit" class="btn btn-lg btn-primary me-2"><?php echo $callAction; ?></button>
            <a href="/mis-negocios" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</form>
