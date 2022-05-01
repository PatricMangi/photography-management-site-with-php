<!DOCTYPE html>
<html lang="en">
<head>
    <link href="Admin/css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Responsive navbar-->
<?php
include('connection/connection.php');
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
    }
    if ($query->rowCount() == 0) {
        $query = $pdo->prepare("INSERT INTO users(username,password,email) VALUES (:username,:password_hash,:email)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo '<p class="success">Your registration was successful!</p>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
?>


<?php ob_start();
/** @var PDO $dbh */ ?>
<html lang="en_AU">
<head>
    <title>User Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="authentication">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['fullname'])) {
        //Run some SQL query here to find that user
        $stmt = $dbh->prepare("INSERT INTO `users`(`fullname`, `username`, `password`) VALUES (:fullname, :username, SHA2(:password, 0))");
        if ($stmt->execute([
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']  //Or you can hash the password in PHP: hash('sha256', $_POST['password']) - don't hash the password TWICE!
        ])) {
            //Successfully registered, redirect user to login
            header("Location: login.php");
        } else {
            echo "<h1>Cannot register!</h1><div>Error message: " . $stmt->errorInfo()[2] . "</div>";
        }
    }
} else {
    if (isset($_SESSION['user_id'])) {
        $user_stmt = $dbh->prepare("SELECT * FROM `users` WHERE `id` = ?");
        if ($user_stmt->execute([$_SESSION['user_id']]) && $user_stmt->rowCount() == 1) {
            //User already logged in, redirect user to dashboard
            header("Location: dashboard.php");
        } else {
            session_destroy();
            header("Location: login.php");
        }
    }
}
?>

<!--
<form method="post" action="" name="signup-form">
    <div class="form-element">
        <label>Username</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Email</label>
        <input type="email" name="email" required />
    </div>
    <div class="form-element">
        <label>Password</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="register" value="register">Register</button>
</form>
-->


<!--
<style>

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    body {
        margin: 50px auto;
        text-align: center;
        width: 800px;
    }
    h1 {
        font-family: 'Passion One';
        font-size: 2rem;
        text-transform: uppercase;
    }
    label {
        width: 150px;
        display: inline-block;
        text-align: left;
        font-size: 1.5rem;
        font-family: 'Lato';
    }
    input {
        border: 2px solid #ccc;
        font-size: 1.5rem;
        font-weight: 100;
        font-family: 'Lato';
        padding: 10px;
    }
    form {
        margin: 25px auto;
        padding: 20px;
        border: 5px solid #ccc;
        width: 500px;
        background: #eee;
    }
    div.form-element {
        margin: 20px 0;
    }
    button {
        padding: 10px;
        font-size: 1.5rem;
        font-family: 'Lato';
        font-weight: 100;
        background: yellowgreen;
        color: white;
        border: none;
    }
    p.success,
    p.error {
        color: white;
        font-family: lato;
        background: yellowgreen;
        display: inline-block;
        padding: 2px 10px;
    }
    p.error {
        background: orangered;
    }
</style>

-->


<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                            <div class="card-body">
                                <form method="post" action="" name="signup-form">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input  class="form-control" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
                                        <label>Username</label>
                                    </div>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input  class="form-control" type="email" name="email" required />
                                        <label>Email</label>
                                    </div>
                                    <div class="form-floating mb-3 mb-md-0">

                                        <input class="form-control" type="password" name="password" required />
                                        <label>Password</label>
                                    </div>
                                    <button  class="btn btn-primary btn-block" type="submit" name="register" value="register">Register</button>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</html>