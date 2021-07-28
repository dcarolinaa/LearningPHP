<a href="/mis-negocios/<?php echo $company->getId()?>">
    <h1><img src="/img/shushi-go.jpg" height="35" class="me-1"><?php echo $company->getName()?></h1>
</a>

<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3>Equipo / Invitar Colaborador</h3>
    </div>
    <div class="card">
        <div class="card-header">
           
        </div>
        <div class="card-body">
        <form action="/mis-negocios/<?php echo $company->getId();?>/equipo/send-invitacion" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $company->getId()?>" />
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control form-control-lg" value="<?php echo $email ?>" type="text" name="email" placeholder="Nombre">
                        <?= $this->view('errors', ['attribute' => 'email', 'errors' => $errors],true) ?>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <label class="form-label">Perfil:</label>
                        <select class="form-control" name="rol">
                            <option value="<?php echo $rolBranchAdmin ?>">Administrador de sucursal</option>
                            <option value="<?php echo $rolDelivery ?>">Repartidor</option>
                        </select>
                    </div>

                    <div class="col-md-6 offset-md-3">
                        <label class="form-label">Sucursal:</label>
                        <select class="form-control" name="branch">
                            <?php foreach($branchesList as $branch): ?>

                            <option value="<?php echo $branch['id'] ?>"><?php echo $branch['name'] ?></option>                            

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">        
                        <button type="submit" class="btn btn-lg btn-primary me-2">Enviar</button>
                        <a href="/mis-negocios" class="btn btn-lg btn-secondary" >Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
