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
    <input type="hidden" name="id_company" value="<?php echo $company->getId(); ?>" />
    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Nombre:</label>
            <input class="form-control form-control-lg" value="" type="text" name="name" placeholder="Nombre">
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Teléfono:</label>
            <input class="form-control form-control-lg" value="<?php echo $company->getName(); ?>" type="text" name="telephone" placeholder="Teléfono">
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Celular:</label>
            <input class="form-control form-control-lg" value="<?php echo $company->getName(); ?>" type="text" name="cellphone" placeholder="Celular">
        </div>
        <div class="col-md-6 offset-md-3">
            <label class="form-label">Email:</label>
            <input class="form-control form-control-lg" value="<?php echo $company->getName(); ?>" type="text" name="email" placeholder="Email">
        </div>
        <div class="col-md-6 offset-md-3">
            <div id="map"></div>
            <label class="form-label">Direccion:</label>
            <input class="form-control form-control-lg" value="" type="text" name="address" placeholder="Direccion">
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
        
        const myLatlng = { lat: 20.872407599296846, lng:  -101.51664921720504 };
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
