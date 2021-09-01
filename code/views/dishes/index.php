<a href="/mis-negocios/<?php echo $company->getSlug(); ?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName(); ?></h1>
</a>
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Platillos</h3>
    </div>
    <div class="card">
        <div class="card-header">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/mis-negocios/<?php echo $company->getSlug(); ?>/platillos/nuevo" id="btn-new">Nuevo Platillo</a></li>
        </ol>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>                    
                    <?php foreach ($dishes as $index => $dish) : ?>
                    <tr>
                        <td></td>
                        <td>
                              <a href="/sucursales/<?php echo $company->getSlug(); ?>"><?php echo $dish['name']; ?></a>
                              <div><?php echo $dish['description']; ?></div>
                        </td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/platillos/<?php echo $dish['id']; ?>/confirm-delete" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>/platillos/<?php echo $dish['id']; ?>/edit" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                     
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
