<?php
require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}
$sql = "DELETE FROM favoriteanime 
WHERE idfavoriteanime=" . $_POST["anime"] . ";";
$results = $mysqli->query($sql);
if (!$results) {
    echo $mysqli->query(($sql));
    exit();
}
if ($results !== false) {
    $message = "Successfully deleted!";
} else {
    $message = "There was an error. Could not delete.";
}

$mysqli->close();
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
    <title>Confirmation</title>
    <style>
        #main-text {
            font-size: 150%;
            margin-top: 5%;
            color: darkgreen;
        }

        body {
            background: rgb(174, 203, 252);
            background: radial-gradient(circle, rgba(174, 203, 252, 0.36207986612613796) 0%, rgba(211, 231, 247, 0.8018557764902836) 100%);
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="center-align" id="main-text">
        <?php
        echo $message;
        ?>
    </div>

</body>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>

</html>