<?php
require 'config/config.php';
//var_dump($_POST);
//echo "got to line 3";
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    if (isset($_POST['username']) && isset($_POST['password_one'])) {
        $username = $_POST['username'];
        $password_one = $_POST['password_one'];
        $password_two = $_POST['password_two'];
        //echo "GOT TO LINE 10";
        //echo $password_two . " " . $password_one;
        if (strcmp($password_one, $password_two) == 0) {
            // DB Stuff
            $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($mysqli->connect_errno) {
                echo $mysqli->connect_error;
                exit();
            }
            // Hash password input
            $passwordInput = hash("sha256", $password_one);

            // Check if user exists 
            $sql = "SELECT * FROM users
            WHERE username = '" . $username . "';";

            $results = $mysqli->query($sql);
            if (!$results) {
                echo $mysqli->error;
                exit();
            }
            //echo "GOT TO LINE 33";
            if ($results->num_rows >= 1) {
                echo '<script>alert("This user exists.");</script>';
            } else {
                //insert sql statement
                $statement = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

                if ($statement) {
                    $statement->bind_param("ss", $username, $passwordInput);
                    $executed = $statement->execute();
                } else {
                    $error = $mysqli->errno . ' ' . $mysqli->error;
                    echo $error;
                }

                if (!$executed) {
                    echo $mysqli->error;
                }
                // returns # of rows changed
                if ($statement->affected_rows != 1) {
                    echo '<script>alert("Internal error has occurred");</script>';
                }
                //echo "GOT TO 55";
                header("Location: login.php");
                $statement->close();
            }
            $mysqli->close();
        } else {
            header("Location: register.php");
        }
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
        #register-text {
            margin-left: auto;
            margin-right: auto;
            margin-top: 5%;
            margin-bottom: 2%;
            font-size: 120%;
            text-align: center;
        }

        .form-group {
            margin-bottom: 0px;
        }
    </style>
    <title>Register</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div id="register-text">
        <p>Register Now!</p>
    </div>
    <div class="container">
        <form action="register.php" method="POST" id="register-form">
            <div class="form-group row">
                <div class="input-field col s10 m4 l4 offset-s1 offset-m4 offset-l4">
                    <input type="email" class="form-control" id="username-id" name="username" placeholder="aniworld@email.com" required>
                    <label for="username-id" class="col">Email:</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="input-field col s10 m4 l4 offset-s1 offset-m4 offset-l4">
                    <input type="password" class="form-control" id="password-one" name="password_one" placeholder="" required>
                    <label for="password-one" class="col">Password:</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="input-field col s10 m4 l4 offset-s1 offset-m4 offset-l4">
                    <input type="password" class="form-control" id="password-two" name="password_two" placeholder="" required>
                    <label for="password-two" class="col">Confirm Password:</label>
                </div>
            </div>
            <div class="form-group row center-align">
                <button class="waves-effect waves-teal btn-small" id="SubmitButton" type="submit">Sign Up!
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
        $('#register-form').submit(function(event) {
            //event.preventDefault();
            var user = $('#username-id').val();
            var passOne = $('#password-one').val();
            var passTwo = $('#password-two').val();
            console.log(user, passOne, passTwo);
            // Check if the two passwords are the same 
            if (passOne.localeCompare(passTwo) != 0) {
                alert("Passwords are not the same. Try again.");
                // $('#password-one').val('');
                // $('#password-two').val('');
            } else if (user.length == 0 || passOne.length == 0 || passTwo.length == 0) {
                alert("Invalid input.");
                $('#username-id').val('');
                $('#password-one').val('');
                $('#password-two').val('');
            }
        });
    </script>
</body>

</html>