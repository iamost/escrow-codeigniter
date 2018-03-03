<header class="masthead">
    <div class="container">
        <div class="intro-text">
            <div class="intro-heading text-uppercase text-dark">MAKING ONLINE <br>TRANSACTION SAFE</div>
            <div class="intro-lead-in text-dark">Buy or Sell online without<br>facing risk of fraud</div>
            <a class='btn btn-primary btn-xl text-white' href="<?= base_url(); ?>login">Get Started</a>
        </div>
    </div>
</header>

<!--About Section-->
<section class="bg-light p-5" id="about">
    <div class="container">
        <h1 class="text-center text-uppercase font-weight-bold text-dark">About</h1>
        <hr class="star-light mb-5">
        <div class="row">
            <div class="col-md-4 ml-auto">
                <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
            </div>
            <div class="col-md-4 mr-auto">
                <p class="lead">Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
            </div>
        </div>
        <div class="row">
            <a class='btn btn-primary btn-xl text-white mx-auto' href="<?= base_url(); ?>login">Get Started</a>
        </div>
    </div>
</section>

<!--Contact Us Section-->
<section class="bg-dark p-5" id="contact">
    <div class="container">
        <h1 class="text-center text-uppercase">Contact Me</h1>
        <hr class="star-white mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Name</label>
                            <input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Email Address</label>
                            <input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Phone Number</label>
                            <input class="form-control" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Scroll to Top Button -->
<div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded p-3" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>