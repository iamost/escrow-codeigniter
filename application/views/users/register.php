<div class="container">
    <?php echo validation_errors(); ?>
    <?php echo form_open('users/register'); ?>
    <div class="row my-4">
        <div class="col-md-8 mx-auto card bg-light p-3">
            <h1 class="text-center text-dark mb-3"><?= $title; ?></h1>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name: First, Last" required autofocus>
            </div>
            <div class="form-group row">
                <div class='col'>
                    <input type="text" class="form-control" name="streetadr" placeholder="Street Address" required autofocus>
                </div>
                <div class='col'>
                    <input type="text" class="form-control" name="address" placeholder="Address" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class='col'>
                    <input type="text" class="form-control" name="city" placeholder="City" required autofocus>
                </div>
                <div class='col'>
                    <input type="text" class="form-control" name="state" placeholder="State">
                </div>
                <div class='col'>
                    <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="phone" placeholder="Phone Number" required autofocus>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
            <!--<div class="row">-->
                <div class="mx-auto">Already Registered?</div>
                <a href="<?php echo base_url(); ?>login" class="mx-auto">Login Here</a>
            <!--</div>-->
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
