<form method="POST" action="<?= $action ?>">
    <div class="mb-3 row">
        <label for="first_name" class="col-sm-2 col-form-label"> First Name: </label>
        <div class="col-sm-10 position-relative">
            <input type="text" id="first_name" name="first_name" class="form-control" 
                placeholder="First Name" value="<?php echo $user->getFirst_name(); ?>"
            >
            <?= $this->view('errors', ['attribute' => 'first_name', 'errors' => $errors],true) ?>
        </div>        
    </div>

    <div class="mb-3 row">
        <label for="last_name" class="col-sm-2 col-form-label"> Last Name: </label>
        <div class="col-sm-10 position-relative">
            <input type="text" id="last_name" name="last_name" class="form-control" 
                placeholder="Last Name" value="<?php echo $user->getLast_name(); ?>"
            >            
        </div>        
    </div>

    <div class="mb-3 row">
        <label for="birthdate" class="col-sm-2 col-form-label"> Birth date: </label>
        <div class="col-sm-10">
            <input type="date" id="birthdate" name="birthdate" class="form-control" 
                placeholder="Birth Date" value="<?php echo $user->getBirthdate(); ?>"
            >
            <?= $this->view('errors', ['attribute' => 'birthdate', 'errors' => $errors],true) ?>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label"> E-mail: </label>
        <div class="col-sm-10 position-relative">
            <input type="text" id="email" name="email" class="form-control" 
                placeholder="E-mail" value="<?php echo $user->getEmail(); ?>"
            >
            <?= $this->view('errors', ['attribute' => 'email', 'errors' => $errors],true) ?>
        </div>        
    </div>

    <!--phone_number -->
    <div class="mb-3 row">
        <label for="phone_number" class="col-sm-2 col-form-label"> Teléfono: </label>
        <div class="col-sm-10 position-relative">
            <input type="text" id="phone_number" name="phone_number" class="form-control" 
                placeholder="Teléfono" value="<?php echo $user->getPhone_number(); ?>"
            >            
        </div>        
    </div>

    <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label"> Username: </label>
        <div class="col-sm-10 position-relative">
            <input type="text" id="username" name="username" class="form-control" 
                placeholder="Username" value="<?php echo $user->getUsername(); ?>"
            >
            <?= $this->view('errors', ['attribute' => 'username', 'errors' => $errors],true) ?>
        </div>        
    </div>

    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label"> Password: </label>
        <div class="col-sm-10">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <?= $this->view('errors', ['attribute' => 'password', 'errors' => $errors],true) ?>
        </div>
    </div>

    <div class="mb-3 row">
        <input type="submit" value="Sign-up" id="" class="btn btn-primary">
    </div>

    <!-- first_name varchar(100),
            last_name varchar(100),
            birthdate date,
            email varchar(150),
            username varchar(50),
            password varchar(10), -->    
</form>