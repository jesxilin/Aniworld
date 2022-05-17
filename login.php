<?php
// session_start();
require 'config/config.php';
//var_dump($_POST);
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    if (isset($_POST['SubmitButton'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username . " + " . $password;

        // // Check if the user and password is someone in our database 
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }
        // Hash password input
        $passwordInput = hash("sha256", $_POST['password']);

        //echo "hashed password is: " . $passwordInput;

        $sql = "SELECT * FROM users
            WHERE username = '" . $username
            . "'AND password = '" . $passwordInput . "';";
        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            exit();
        }

        // If correct, should only have one person returning
        if ($results->num_rows == 1) {
            // we are correct, log user in 
            $_SESSION['logged_in'] = true;
            //echo "GOT TO LINE 36";
            //Redirect user to search page
            header("Location: search.php");
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
            //echo "GOT TO LINE 41";
        }
        $mysqli->close();
    }
} else {
    //redirect user to index page 
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="navstyle.css">
    <style>
        .input-field {
            color: #00695c;
        }

        #above-text {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            margin-top: 7%;
            margin-bottom: 2%;
            font-size: 120%;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div id="above-text">
        <p>It's great to see you again!</p>
    </div>
    <div class="container">
        <form action="login.php" method="POST" id="login-form">
            <div class="form-group row">
                <div class="input-field col s10 m4 l4 offset-s1 offset-m4 offset-l4">
                    <input type="email" class="form-control" id="username-id" name="username" placeholder="aniworld@email.com">
                    <label for="username-id" class="col">Username:</label>
                    <!-- <input id="username_id" type="email" class="validate" name="username" placeholder="aniworld@email.com">
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="wrong" data-success="right">is this email valid?</span> -->
                </div>
            </div>
            <div class="form-group row">
                <div class="input-field col s10 m4 l4 offset-s1 offset-m4 offset-l4">
                    <input type="password" class="form-control" id="password-id" name="password">
                    <label for="password-id" class="col">Password:</label>
                </div>
            </div>
            <div class="form-group row center-align">
                <button class="waves-effect waves-teal btn-small" id="submitButton" name="SubmitButton" type="submit" value="true">Log in!
                    <i class="material-icons right">navigate_next
                    </i>
                </button>
            </div>

        </form>
    </div>


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav();
    </script>
    <script>
        $('#login-form').submit(function(event) {
            ///event.preventDefault();
            var user = $('#username-id').val();
            var pass = $('#password').val();
            if (!user && !pass) {
                alert("Invalid input. Please try again.");
            }
            if (!String(user).toLowerCase().match(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)) {
                alert("Invalid input. Please try again.");
            }
        });
    </script>
</body>

</html>