<a href="/mis-negocios/<?php echo $company->getSlug(); ?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName(); ?></h1>
</a>
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Products</h3>
    </div>
    <div class="card">
        <div class="card-header">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/mis-negocios/<?php echo $company->getSlug(); ?>/productos/nuevo" id="btn-new">Nuevo Producto</a></li>
        </ol>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <?php
                    foreach ($products as $product) :
                            $imageUrl = sprintf('/imagenes/%s/productos/producto-%s_w300v%s.jpg',
                                $company->getSlug(),
                                $product->getId(),
                                (new \DateTime($product->getUpdate_date()))->format('U')
                        );
                        ?>
                    <tr>
                        <td><img src="<?php echo $imageUrl; ?>" height="35"></td>
                        <td>
                              <?php echo $product->getName(); ?>
                              <div><?php echo $product->getDescription(); ?></div>
                        </td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/productos/<?php echo $product->getId(); ?>/confirm-delete" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/productos/<?php echo $product->getId(); ?>/edit" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                     
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
