<?php
ob_start(); // To allow setting header when there's already page contents rendered
$PAGE_ID = "login";

require 'connection/connection.php';

/** @var PDO $dbh Database connection */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        //Run some SQL query here to find that user
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $stmt->execute([
            'username' => $_POST['username']
        ]);
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetchObject();
            if(password_verify($_POST['password'], $row->password)) {
                $_SESSION['user_id'] = $row->id;
                //Successfully logged in, redirect user to referer, or index page
                if (empty($_SESSION['referer'])) {
                    header("Location: index.php");
                } else {
                    if($_SESSION['referer'] != '/project-1/register.php') {
                        header("Location: " . $_SESSION['referer']);
                    } else {
                        header("Location: index.php");
                    }

                }
            } else {
                header("Location: login.php?action=error&message=" . urlencode('Your username and/or password is incorrect. Please try again!'));
            }

        } else {
            header("Location: login.php?action=error&message=" . urlencode('Your username and/or password is incorrect. Please try again!'));
        }
    } else {
        header("Location: login.php?action=error&message=" . urlencode('Please enter both username and password to login!'));
    }
    exit();
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="Admin/css/styles.css" rel="stylesheet" />
<body class="bg-primary">
<!--<form method="post" action="" name="signin-form">-->
<!--    <div class="form-element">-->
<!--        <label>Username</label>-->
<!--        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />-->
<!--    </div>-->
<!--    <div class="form-element">-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password" required />-->
<!--    </div>-->
<!--    <button type="submit" name="login" value="login">Log In</button>-->
<!--</form>-->




<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Please login</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="loginUsername" name="username" aria-describedby="emailHelp" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="loginUserPassword" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center py-3">
                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                </div>

            </div>

        </div>

    </div>

</div>

<!--
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form method="post" action="" name="signin-form">
                                    <div class="form-floating mb-3">
                                        <input  class="form-control" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
                                        <label>Username</label>
                                    </div>
                                    <div class="form-floating mb-3">

                                        <input class="form-control" type="password" name="password" required />
                                        <label>Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Forgot Password?</a>
                                    <button  class="btn btn-primary" type="submit" name="login" value="login">Log In</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
-->

<!-- Error Message Modal-->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">You have logged out successfully.</div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="Admin/js/scripts.js"></script>
</body>



<style>


</style>
