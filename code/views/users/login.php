<div class="col-4 offset-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Login</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo $action; ?>">
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label"> Username/Email: </label>
                    <div class="col-sm-10">
                        <input type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            placeholder="Username/Email"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label"> Password: </label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>

                <div class="mb-3 row">
                    <input type="submit" value="Sign-In" id="" class="btn btn-primary">
                </div>
                <div class="row">
                    <a href="<?php echo $signUpUrl; ?>"> Sign Up </a>
                </div>
            </form>
        </div>
    </div>
</div>