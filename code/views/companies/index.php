<h1 class="h3 mb-3"> Negocios </h1>
<div class="card">
    <div class="card-header">
        <a href="/mis-negocios/nuevo" id="btn-new"> Nuevo negocio </a>
    </div>
    <div class="card-body">
        <table class="table table-striped">            
            <tbody>
                <?php for($i=0; $i<10; $i++): ?>
                <tr>
                    <td>
                        <a href="/mis-negocios/<?php echo $i?>"><img src="img/shushi-go.png" height="35"> Negocio <?php echo $i?></a>
                    </td>
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
