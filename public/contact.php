
<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->


<div class="container">
    <div class="row">

<header class="sb-page-header">
    <div class="container">
        <h1 class="text-center header">Contact Us</h1>
        <p class="text-center">If you have any questions or suggestions, please don't hesitate to send us a message</p>
    </div>
</header>
        <div class="col-md-12">
                <form class="form-horizontal" id ="contactForm" method="post">				
                    <fieldset>
                        <legend class="text-center header"></legend>
                        <h2 class="text-center bg-warning"><?php display_message(); ?></h2>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="name" name="name" type="text" placeholder="First Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                            </div>
                        </div>

						 <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control">
                            </div>
                        </div>
						
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button name="submit" type="submit" class="btn btn-primary btn-lg">Send message</button>
                            </div>
                        </div>
                    </fieldset>
                    <?php save_message(); // pozivamo funkciju iz functions.php koja spasava poslane poruke u bazu ?>
                </form>

        </div>
    </div>
</div>

<!-- validacija contact forme -->
<?php include(TEMPLATE_FRONT . DS . "footer_for_contact.php"); ?>  <!-- poziv footer_for_contact.php fajla iz TEMPLATE_FRONT -->
