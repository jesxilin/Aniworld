<?php
require 'config/config.php';
//var_dump($_POST);
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}
if (!isset($_POST["anime"])) {
    $error = "Did not select an anime to edit. Try again.";
} else {
    // Update stuff
    if (isset($_POST["genre"])) {
        $sql_genre = "UPDATE favoriteanime
        SET genres_idgenres = '" . $_POST["genre"] .
            "' WHERE idfavoriteanime = " . $_POST["anime"] . ";";
        $results_genre = $mysqli->query($sql_genre);
        if (!$results_genre) {
            echo $mysqli->errno . ' ' . $mysqli->error;
            $error = "Error updating genre.";
            exit();
        }
    }
    //echo "GOT TO LINE 27";
    if (isset($_POST["desc"]) && !empty($_POST["desc"])) {
        $sql_desc = "UPDATE favoriteanime
        SET description = '" . $_POST["desc"] .
            "' WHERE idfavoriteanime = " . $_POST["anime"] . " ;";
        //echo $sql_desc;
        $results_desc = $mysqli->query($sql_desc);
        //echo "GOT TO LINE 33";
        if (!$results_desc) {
            echo $mysqli->errno . ' ' . $mysqli->error;
            $error = "Error updating description.";
            //echo "GOT TO LINE 38";
            exit();
        }
    }
}
$mysqli->close()
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
        if (!empty($error)) {
            echo $error;
        } else {
            echo "Successfully changed!";
        }
        ?>
    </div>

</body>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>

</html>