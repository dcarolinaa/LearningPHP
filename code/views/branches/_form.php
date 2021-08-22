<?php
    $lat = $branch->getLat() ? $branch->getLat() : 20.872407599296846;
    $lng = $branch->getLng() ? $branch->getLng() : -101.51664921720504;
?>
<style>
    #map {
        height: 300px;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $branch->getId(); ?>" />
    <input type="hidden" name="id_company" value="<?php echo $company->getId(); ?>" />
    <input type="hidden" value="<?php echo $branch->getLat(); ?>" name="lat" id="lat">
    <input type="hidden" value="<?php echo $branch->getLng(); ?>" name="lng" id="lng">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Nombre:</label>
            <input class="form-control form-control-lg" value="<?php echo $branch->getName(); ?>" type="text" name="name" placeholder="Nombre">
            <?php echo $this->view('errors', ['attribute' => 'name', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Teléfono:</label>
            <input class="form-control form-control-lg" value="<?php echo $branch->getTelephone(); ?>" type="text" name="telephone" placeholder="Teléfono">
            <?php echo $this->view('errors', ['attribute' => 'telephone', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Celular:</label>
            <input class="form-control form-control-lg" value="<?php echo $branch->getCellphone(); ?>" type="text" name="cellphone" placeholder="Celular">
            <?php echo $this->view('errors', ['attribute' => 'cellphone', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Email:</label>
            <input class="form-control form-control-lg" value="<?php echo $branch->getEmail(); ?>" type="text" name="email" placeholder="Email">
            <?php echo $this->view('errors', ['attribute' => 'email', 'errors' => $errors], true); ?>
        </div>
        <div class="col-md-6 offset-md-3">
            <div id="map"></div>
            <label class="form-label">Direccion:</label>
            <input class="form-control form-control-lg"  value="<?php echo $branch->getAddress(); ?>" type="text" name="address" placeholder="Direccion">
            <?php echo $this->view('errors', ['attribute' => 'address', 'errors' => $errors], true); ?>
        </div>
        <div class="mt-3 offset-md-3 col-md-6 d-flex justify-content-end">        
            <button type="submit" class="btn btn-lg btn-primary me-2"><?php echo $callAction; ?></button>
            <a href="/mis-negocios/<?php echo $company->getSlug(); ?>" class="btn btn-lg btn-secondary" >Cancelar</a>
        </div>
    </div>
</form>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    function initMap() {
        
        const myLatlng = { lat: <?php echo $lat; ?>, lng:  <?php echo $lng; ?> };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: myLatlng,
        });
        const marker = new google.maps.Marker({
            position: myLatlng,
            map,
            title: "Click to zoom",
        });

        map.addListener("click", (event) => {
            console.log(event.latLng.lng());
            marker.setPosition(event.latLng);
            map.panTo(marker.getPosition());
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('lng').value = event.latLng.lng();
        });
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleApiKey; ?>&callback=initMap&libraries=&v=weekly"
    async
></script>
