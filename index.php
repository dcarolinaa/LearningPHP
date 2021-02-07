<?php
    function isSelectedCountry($country, $selectedContury) {
        
        if($country['value'] === $selectedContury) {
            return 'selected';
        }

        return '';
    }

    $selectedContury = @$_POST['country'];
    $selectedGender = @$_POST['gender'];

    $CountriesArr=[
        [
            'value'=> "",
            'name' => 'Select a country'
        ],
        [
            'value' => 'mx',
            'name' => 'México'
        ],
        [
            'value' => 'us',
            'name' => 'U.S.'
        ],
        [
            'value' => 'pr',
            'name' => 'Preú'
        ],
        [
            'value' => 'ch',
            'name' => 'Chile'
        ],
        [
            'value' => 'col',
            'name' => 'Colombia'
        ]               
    ];


?>

<html>
<head> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <pre><?php
    var_dump($_POST);
?></pre>
    <div class="container mt-4">

        <h1>Formulario</h1>
        <form action="index.php" method="POST">
            <div class="form-group row">
                <label for=name class="col-form-label col-sm-2"> Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control" value="<?= @$_POST['name']?>">            
                </div>
            </div>
            <div class="form-group row">
                <label for=adress class="col-form-label col-sm-2">Adress:</label>
                <div class="col-sm-10">
                    <input type="text" id="adress" name="adress" class="form-control" value="<?= @$_POST['adress']?>">          
                </div>
            </div>
            <div class="form-group row">
                <label for=zipcode class="col-form-label col-sm-2"> Zip Code:</label>
                <div class="col-sm-10">
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?= @$_POST['zipcode']?>">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="countryid" class="col-form-label col-sm-2">Country</label>
                <div class="col-sm-10">
                    <select id="countryid" name="country" class="form-control">
                        <?php foreach($CountriesArr as $country):?>
                            <option value="<?= $country['value']?>" <?= isSelectedCountry($country, $selectedContury) ?>> <?= $country['name']?> </option>
                        <?php endforeach?>                        
                    </select>
                </div>
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="gendermale" type="radio" <?php 
                            /**
                             * Esto no se debe hacer :3 pero se deja para ejemplo de que también funciona c:
                             */
                            if($selectedGender === 'M'):?>
                                checked
                            <?php endif?>  
                            name="gender" value="M" class="form-check-input">
                            <label class="form-check-label" for="gendermale">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="genderfemale" type="radio"                             
                            <?php 
                            /**
                             * Esto no se debe hacer :3 pero se deja para ejemplo de que también funciona c:
                             */
                            if($selectedGender === 'F'):?>
                                checked
                            <?php endif?>
                            name="gender" value="F" class="form-check-input">
                            <label class="form-check-label" for="genderfemale">
                                Female
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Preferences:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input id="green" type="checkbox" checked name="preference[]" value="green" class="form-check-input">
                            <label class="form-check-label" for="green">
                                Green
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="blue" type="checkbox" name="preference[]" value="blue" class="form-check-input">
                            <label class="form-check-label" for="blue">
                                Blue
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="black" type="checkbox" checked name="preference[]" value="black" class="form-check-input">
                            <label class="form-check-label" for="black">
                                Black
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>



            <div class="form-group row">
                <label for=phone class="col-form-label col-sm-2"> Phone:</label>
                <div class="col-sm-10">
                    <input type="text" id="phone" name="phone" class="form-control" value="<?= @$_POST['phone']?>">
                </div>
            </div>
            <div class="form-group row">
                <label for=email class="col-form-label col-sm-2"> Email:</label>
                <div class="col-sm-10">
                    <input type="text" id="email" name="email" class="form-control" value="<?= @$_POST['email']?>">
                </div>
            </div>
            <div class="form-group row">
                <label for=pass class="col-form-label col-sm-2"> Password:</label>
                <div class="col-sm-10">
                    <input type="password" id="pass" name="pass" class="form-control" value="<?= @$_POST['pass']?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Send</button>
            <button type="reset" class="btn btn-primary mb-2">Clear</button>
            
        </form>        
    </div>
</body>
</html>

