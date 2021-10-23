<a href="/mis-negocios/<?php echo $company->getSlug(); ?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName(); ?></h1>
</a>
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Categorias de productos</h3>
    </div>
    <div class="card">
        <div class="card-header">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/mis-negocios/<?php echo $company->getSlug(); ?>/categorias-de-productos/nueva" id="btn-new">Nueva Categoria</a></li>
        </ol>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <?php
                    foreach ($categories as $category) :
                        ?>
                    <tr>
                        <td>
                              <?php echo $category->getName(); ?>
                        </td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/categorias-de-productos/<?php echo $category->getId(); ?>/confirm-delete" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/categorias-de-productos/<?php echo $category->getId(); ?>/edit" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
