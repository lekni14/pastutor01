<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="UTF-8" />
        <title>PASTUTOR | สถาบันกวดวิชาพี่เอก</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!--[if IE]>
           <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
           <![endif]-->
        <!-- GLOBAL STYLES -->
        <!-- PAGE LEVEL STYLES -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/magic/magic.css" />
        <!-- END PAGE LEVEL STYLES -->

        <!-- PAGE validationengine STYLES -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/validationengine/css/validationEngine.jquery.css" />
        <!-- END validationengine LEVEL STYLES -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body >

        <!-- PAGE CONTENT --> 
        <div class="container">
            <div class="text-center">
                <img src="<?php echo base_url(); ?>img/logo.png" id="logoimg" alt=" Logo" />
            </div>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                        <?php echo form_open('','class="form-signin"'); ?>
                        <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                            Enter your username and password
                        </p>
                        <input type="text" name="username" placeholder="Username" class="form-control" />
                        <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                        <input type="password" name="password" placeholder="Password" class="form-control" />
                        <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        <button class="btn text-muted text-center btn-danger" type="submit">Sign in</button>
                    </form>
                </div>
                <div id="forgot" class="tab-pane">
                    <form action="index.html" class="form-signin">
                        <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                        <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
                        <br />
                        <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
                    </form>
                </div>
                <div id="signup" class="tab-pane">
                    <form action="index.html" class="form-signin">
                        <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register</p>
                        <input type="text" placeholder="First Name" class="form-control" />
                        <input type="text" placeholder="Last Name" class="form-control" />
                        <input type="text" placeholder="Username" class="form-control" />
                        <input type="email" placeholder="Your E-mail" class="form-control" />
                        <input type="password" placeholder="password" class="form-control" />
                        <input type="password" placeholder="Re type password" class="form-control" />
                        <button class="btn text-muted text-center btn-success" type="submit">Register</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <ul class="list-inline">
                    <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
                    <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
                    <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
                </ul>
            </div>


        </div>

        <!--END PAGE CONTENT -->     

        <!-- PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
        <!--END PAGE LEVEL SCRIPTS -->

        <!-- PAGE validationengine SCRIPTS -->

        <script src="<?php echo base_url(); ?>assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validationInit.js"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery("#inline-validate").validationEngine();
                $("#inline-validate").bind("jqv.field.result", function (event, field, errorFound, prompText) {
                    console.log(errorFound)
                })
            });
        </script>
        <!--END PAGE validationengine SCRIPTS -->

    </body>
    <!-- END BODY -->
</html>
