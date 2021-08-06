<table class="table table-striped">            
    <thead>
        <tr>
            <td>
                Nombre
            </td>
            <td>Telefono</td>
            <td>Rol</td>
            <td>Sucursal</td>
            <td>
                &nbsp;
            </td>
        </tr>
    </thead>
    <tbody>                    
        <?php foreach ($workers as $worker) : ?>
        <tr>
            <td>
                <?php printf('%s %s', $worker['first_name'], $worker['last_name'] ); ?>
            </td>
            <td>
                <?php printf('%s', $worker['phone_number']); ?>
            </td>
            <td>
                <?php printf('%s', $worker['rol_name']); ?>
            </td>
            <td>@<?php printf('%s', $worker['branch_name']); ?>
                <a href="/mis-negocios/<?php echo $company->getId(); ?>/equipo/confirm-remove-adminitration/<?php echo $worker['id']; ?>" class="text-danger"><i class="align-middle me-2" data-feather="minus-circle"></i></a>
            </td>
            <td>
                <a href="/mis-negocios/<?php echo $company->getId(); ?>/equipo/confirm-remove/<?php echo $worker['id']; ?>" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>