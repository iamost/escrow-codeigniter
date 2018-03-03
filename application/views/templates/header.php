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
        <script src="<?php echo base_url(); ?>assets/js/home.js"></script>
        <!--<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>-->
    </head>
    <body id="page-top">
        <?php if (!$this->session->userdata('logged_in')): ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNav">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">The JOTA</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>login">Sign-Up/LogIn</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php else: ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-primary" id="mainNav">
                <div class="container">
                    <a class="navbar-brand text-light" href="<?php echo base_url(); ?>transactions">The JOTA</a>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light" id="secondNav">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor02">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= base_url() ?>transactions">Transactions</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" data-toggle='dropdown' id="requestLink">Request&nbsp;<span class="badge align-top badge-primary" id="count_request"></span></a>
                                <div class="dropdown-menu" aria-labelledby="requestLink" id="reqDropDown">
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" id="notifDrowDownLink">Notifications&nbsp;<span class="badge align-top badge-primary" id="count_notification"></span></a>
                                <div class="dropdown-menu" aria-labelledby="notifDrowDownLink" id="notifDropDown">
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() ?>pm/index">Messages</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="settingsDropDownLink" data-toggle="dropdown">Settings</a>
                                <div class="dropdown-menu" aria-labelledby="settingsDropDownLink">
                                    <a class="dropdown-item text-dark " href="<?= base_url() ?>settings/basic">Basic</a>
                                    <a class="dropdown-item text-dark " href="<?= base_url() ?>settings/payment">Payment</a>
                                    <a class="dropdown-item text-dark " href="<?= base_url() ?>users/logout">Sign Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <script>
                $(document).ready(function () {
                    function load_unseen_notification(view = '')
                    {
                         $.ajax({
                              url: "<?php echo base_url() ?>transactions/getnotifications",
                              method: "POST",
                              data: {view: view},
                              dataType: "json",
                              success: function (data)
                              {
                                $('#count_notification').html(data.count);
                                $('#notifDropDown').html(data.notifications);
                              }
                         });
                    }
                    function load_unseen_request(view = '')
                    {
                         $.ajax({
                              url: "<?php echo base_url() ?>requests/getrequest",
                              method: "POST",
                              data: {view: view},
                              dataType: "json",
                              success: function (data)
                              {
                                $('#count_request').html(data.count);
                                $('#reqDropDown').html(data.requests);
                              }
                         });
                    }
                    load_unseen_notification();
                    load_unseen_request();
                    // load new notifications
                    $('#notifDrowDownLink').click(function () {
                    });
                    setInterval(function () {
                         load_unseen_notification();
                         load_unseen_request();
                        ;
                    }, 5000);
                });
            </script>
        <?php endif; ?>
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
        <?php if ($this->session->flashdata('seller_submitted')): ?>
            <?php echo '<p class="alert alert-success fade show">' . $this->session->flashdata('seller_submitted') . $alertData . '</p>'; ?>
        <?php endif; ?>