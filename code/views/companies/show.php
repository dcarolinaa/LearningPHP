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
                    <?php for($i=0; $i<10; $i++): ?>
                    <tr>
                        <td>
                              <a href="/sucursales/<?php echo $i?>">Branch <?php echo $i?></a>
                        </td>
                        <td>432761598</td>
                        <td>lkajsdf lkjasdf lkjdas</td>
                        <td>@sushigo</td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getId();?>/sucursales/<?php echo $i?>/confirm-delete" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/<?php echo $company->getId()?>/sucursales/<?php echo $i?>/edit" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                     
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
