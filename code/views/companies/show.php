<h1><img src="/img/shushi-go.png" height="35"> Negocio <?php echo $company?></h1>

<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Sucursales</h3>
    </div>
<div class="card">
    <div class="card-header">
            <a href="/mis-negocios/nuevo" id="btn-new">Nueva Sucursal</a>
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
                            <a href="/mis-negocios/confirm-delete/<?php echo $i?>" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/editar/<?php echo $i?>" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<10; $i++): ?>
                    <tr>
                        <td>
                            <a href="/mis-negocios/<?php echo $i?>">Branch <?php echo $i?></a>
                        </td>
                        <td>432761598</td>
                        <td>lkajsdf lkjasdf lkjdas</td>
                        <td>@sushigo</td>
                        <td>
                            <a href="/mis-negocios/confirm-delete/<?php echo $i?>" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                            <a href="/mis-negocios/editar/<?php echo $i?>" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
</div>
    



</div>