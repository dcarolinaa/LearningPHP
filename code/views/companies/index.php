<h1 class="h3 mb-3"> Negocios </h1>
<div class="card">
    <div class="card-header">
        <a href="/mis-negocios/nuevo" id="btn-new"> Nuevo negocio </a>
    </div>
    <div class="card-body">
        <table class="table table-striped">            
            <tbody>
                <?php foreach($companies as $company) :?>
                <tr>
                    <td>
                        <a href="/mis-negocios/<?php echo $company->getId()?>"><img src="img/shushi-go.png" height="35"> <?php echo $company->getName()?></a>
                    </td>
                    <td>
                        <a href="/mis-negocios/confirm-delete/<?php echo $company->getId()?>" class="text-danger"><i class="align-middle me-2" data-feather="trash-2"></i></a>
                        <a href="/mis-negocios/editar/<?php echo $company->getId()?>" class=""><i class="align-middle me-2" data-feather="edit"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
