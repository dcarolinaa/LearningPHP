<a href="/mis-negocios/<?php echo $company->getId()?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName()?></h1>
</a>
<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Administrar Equipo</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="/mis-negocios/<?php echo $company->getId()?>/equipo/invitacion" id="btn-new">Invitar Colaborador</a>
        </div>
        <div class="card-body">

        <?php if (empty($workers)): ?>

            <p> 
                Aún no tienes colaboradores <a href="/mis-negocios/<?php echo $company->getId()?>/equipo/invitacion" id="btn-new">¡invita uno!</a>
            </p>

        <?php else: ?>

            <?php include 'worker-list.php' ?>

        <?php endif ?>


            
        </div>
    </div>
</div>
