<?php echo form_open('users/login'); ?>
<div class="container">
    <div class="row my-4">
        <div class="col-md-4 mx-auto card p-3 bg-light">
            <h1 class="text-center text-dark mb-3"><?php echo $title; ?></h1>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <div class="row justify-content-center align-items-center">
                <div class="col">Not Registered?</div>
                <a href="<?php echo base_url(); ?>register" class="col">Register Here</a>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?> 
</div>