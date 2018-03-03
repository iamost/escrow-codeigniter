<?php
$alertData = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>';
?>
<html lang="en">
    <head>
        <title>The Jota</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css" >
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
    </head>
    <body id="page-top">

        <nav class="navbar navbar-expand-lg navbar-light bg-primary" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-light" href="<?php echo base_url(); ?>admin/dashboard">The JOTA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <?php if ($this->session->flashdata('user_loggedin')): ?>
            <?php echo '<p class="alert alert-success fade show">' . $this->session->flashdata('user_loggedin') . $alertData . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert-danger fade show">' . $this->session->flashdata('login_failed') . $alertData . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('user_registered')): ?>
            <?php echo '<p class="alert alert-success fade show">' . $this->session->flashdata('user_registered') . $alertData . '</p>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('buyer_submitted')): ?>
            <?php echo '<p class="alert alert-success fade show">' . $this->session->flashdata('buyer_submitted') . $alertData . '</p>'; ?>
        <?php endif; ?>