<h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName()?></h1>

<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Sucursales</h3>
    </div>
    <div class="card">
        <div class="card-header">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/mis-negocios/<?php echo $company->getId()?>/sucursales/nuevo" id="btn-new">Nueva Sucursal</a></li>
            <li class="breadcrumb-item"><a href="/mis-negocios/<?php echo $company->getId()?>/equipo">Administrar Equipo</a></li>            
        </ol>
        </div>
        <div class="card-body">
            <table class="table table-striped">            
                <thead>
                    <tr>
                        <td>
                            Sucursal
                        </td>
                        <td>Telefono</td>
                        <td>Direccion</td>
                        <td>Administrador</td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($branches as $branch): ?>
                    <tr>
                        <td>
                              <a href="/sucursales/<?php echo $branch['id']?>"><?php echo $branch['name']?></a>
                        </td>
                        <td><?php echo $branch['telephone'] ?></td>
                        <td><?php echo $branch['address'] ?></td>
                        <td><?php echo $branch['username'] ?></td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getId();?>/sucursales/<?php echo $branch['id']?>/confirm-delete" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/<?php echo $company->getId()?>/sucursales/<?php echo $branch['id']?>/edit" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                     
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
