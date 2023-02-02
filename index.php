<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: profile.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete User Registration & Login System Using PHP & AJAX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        #alert,
        #register-box,
        #forgot-box,
        #loader {
            display: none;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-4">
        <div class="row">

            <div class="col-lg-4 offset-lg-4" id="alert">
                <div class="alert alert-success">
                    <!-- <strong id="result">Hello World</strong> -->
                    <strong id="result">Hello World</strong>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img src="img/loader2.gif" width="60px" height="60px" class="m-2" id="loader">
        </div>

        <!-- LOGIN FORM -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="login-box">
                <h2 class="text-center mt-2">Login</h2>

                <form action="" method="POST" role="form" class="p-2" id="login-form">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php if (isset($_COOKIE['username'])) {
                                                                                                                    echo $_COOKIE['username'];
                                                                                                                } ?>" minlength="2" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" value="<?php if (isset($_COOKIE['password'])) {
                                                                            echo $_COOKIE['password'];
                                                                        } ?>" class="form-control" placeholder="Password" minlength="6" required>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if (isset($_COOKIE['username'])) { ?> checked <?php } ?>>
                            <label for="customCheck" class="custom-control-label">Remember Me</label>

                            <a href="#" id="forgot-btn" class="float-right">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">
                    </div>

                    <div class="form-group">
                        <p class="text-center">New User? <a href="#" id="register-btn">Register Here</a></p>
                    </div>

                </form>

            </div>
        </div>

        <!-- REGISTRATION FORM -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">
                <h2 class="text-center mt-2">Register</h2>

                <form action="" method="POST" role="form" class="p-2" id="register-form">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" minlength="3" required>
                    </div>

                    <div class="form-group">
                        <input type="text" name="uname" class="form-control" placeholder="Username" minlength="4" required>
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Password" minlength="6" id="pass" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" minlength="6" id="cpass" required>
                    </div>


                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
                            <label for="customCheck2" class="custom-control-label">I agree to the
                                <a href="#">terms & conditions.</a>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="register" id="register" value="Register" class="btn btn-primary btn-block">
                    </div>

                    <div class="form-group">
                        <p class="text-center">Already Registered? <a href="#" id="login-btn">Login Here</a></p>
                    </div>

                </form>

            </div>
        </div>

        <!-- FORGOT PASSWORD -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 bg-light rounded" id="forgot-box">
                <h2 class="text-center mt-2">Reset Password</h2>

                <form action="" method="POST" role="form" class="p-2" id="forgot-form">
                    <div class="form-group">
                        <small class="text-muted">
                            To reset your password, enter the email address and we will send reset password instructions on your email.
                        </small>
                    </div>

                    <div class="form-group">
                        <input type="email" name="femail" class="form-coontrol" placeholder="E-Mail" required>
                    </div>

                    <div class=" form-group">
                        <input type="submit" name="forgot" id="forgot" value="Reset" class="btn btn-primary btn-block">
                    </div>

                    <!-- <div class="form-group">
                        <p class="text-center">New User?<a href="#" id="register-btn">Register Here</a></p>
                    </div> -->

                    <div class="form-group text-center">
                        <a href="#" id="back-btn">Back</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            // alert("Hello");



            $("#forgot-btn").click(function() {
                $("#login-box").hide();
                $("#forgot-box").show();
            });



            $("#register-btn").click(function() {
                $("#login-box").hide();
                $("#register-box").show();
            });




            $("#back-btn").click(function() {
                $("#forgot-box").hide();
                $("#login-box").show();

            });

            $("#login-btn").click(function() {
                $("#login-box").show();
                $("#register-box").hide();
            });

            // Validation
            $("#login-form").validate();
            $("#register-form").validate({
                rules: {
                    cpass: {
                        equalTo: "#pass",
                    }
                }
            });

            $("#forgot-form").validate();

            // submit form without page refresh
            $("#register").click(function(e) {
                if (document.getElementById('register-form').checkValidity()) {
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: $("#register-form").serialize() + '&action=register',
                        success: function(response) {
                            $("#alert").show();
                            $("#result").html(response);
                            $("#loader").hide();
                        }
                    });
                }
                return true;
            });


            $("#login").click(function(e) {
                if (document.getElementById('login-form').checkValidity()) {
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: $("#login-form").serialize() + '&action=login',
                        success: function(response) {
                            if (response === "ok") {
                                window.location = "profile.php";
                            } else {
                                $("#alert").show();
                                $("#result").html(response);
                                $("#loader").hide();
                            }

                        }
                    });
                }
                return true;
            });


            $("#forgot").click(function(e) {
                if (document.getElementById('forgot-form').checkValidity()) {
                    e.preventDefault();
                    $("#loader").show();
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: $("#forgot-form").serialize() + '&action=forgot',
                        success: function(response) {
                            $("#alert").show();
                            $("#result").html(response);
                            $("#loader").hide();
                        }
                    });
                }
                return true;
            });

        });
    </script>
</body>

</html>