<h1><img src="/img/shushi-go.png" height="35"> <?php echo $company->getName()?></h1>

<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Equipo</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="/mis-negocios/<?php echo $company->getId()?>/equipo/invitacion" id="btn-new">Invitar Colaborador</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">            
                <thead>
                    <tr>
                        <td>
                            Nombre
                        </td>
                        <td>Telefono</td>                        
                        <td>Sucursal</td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<10; $i++): ?>
                    <tr>
                        <td>
                            Empleado <?php echo $i?>
                        </td>
                        <td>432761598</td>                        
                        <td>@sushigo                         
                            <a href="/mis-negocios/<?php echo $company->getId()?>/equipo/confirm-remove-adminitration/<?php echo $i?>" class="text-danger"><i class="align-middle me-2" data-feather="minus-circle"></i></a>
                        </td>
                        <td>
                            <a href="/mis-negocios/<?php echo $company->getId()?>/equipo/confirm-remove/<?php echo $i?>" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
