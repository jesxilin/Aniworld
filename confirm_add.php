<?php
require 'config/config.php';
//var_dump($_POST);
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    //echo $mysqli->connect_error;
    exit();
}
// Check if the anime already exists 
$sql = "SELECT DISTINCT name 
FROM favoriteanime 
WHERE LOWER(name) LIKE LOWER('%" . $_POST['anime'] . "%');";

$results = $mysqli->query($sql);
if (!$results) {
    //echo $mysqli->query(($sql));
    exit();
}
if ($results->num_rows == 1) {
    $error = "This anime already exists in the list.";
} else {
    // CHECK if genre is inputted 
    if (!isset($_POST["genre"])) {
        $error = "No genre was selected. Try again.";
        //echo "GOT HERE";
    } else {
        // Means we can add the anime 
        $name = $_POST["anime"];
        $desc = $_POST["desc"];
        $genreid = $_POST["genre"];
        // Check if studio exists, if not then add it to studio table 
        $sql = "SELECT idstudios 
        FROM studios 
        WHERE LOWER(name) LIKE LOWER('%" . $_POST['studio'] . "%');";
        $results = $mysqli->query($sql);
        if (!$results) {
            //echo $mysqli->query(($sql));
            exit();
        }
        if ($results->num_rows == 1) {
            // means studio exists, get studio id 
            $row = $results->fetch_assoc();
            $studio_id = $row["idstudios"];
            //echo "STUDIO EXISTS, studio id: " . $studio_id;
        } else {
            //insert new studio into studio table 
            $results_studio = $mysqli->prepare("INSERT INTO studios (name) VALUES (?)");
            if ($results_studio) {
                $results_studio->bind_param("s", $_POST["studio"]);
                $executed = $results_studio->execute();
                // Assume successful 
                // get id of newly added studio 
                $sql_get_studio = "SELECT idstudios 
                FROM studios 
                WHERE LOWER(name) LIKE LOWER('%" . $_POST['studio'] . "%');";
                $results_get_studio = $mysqli->query($sql_get_studio);
                if (!$results_get_studio) {
                    //echo $mysqli->errno . ' ' . $mysqli->error;
                    exit();
                }
                if ($results_get_studio->num_rows == 1) {
                    // get studio id 
                    $row = $results_get_studio->fetch_assoc();
                    $studio_id = $row["idstudios"];
                } else {
                    $error = "There has been an error with adding the studio. Try again later.";
                }
            }
        }
    }
}
// Insert Statement 
$statement = $mysqli->prepare("INSERT INTO favoriteanime (name, description, studios_idstudios, genres_idgenres)
 	VALUES (?, ? ,?, ?)");
$statement->bind_param("ssii", $name, $desc, $studio_id, $genreid);
$executed = $statement->execute();
if ($executed) {
    // means success
} else {
    $error = "There has been an error with adding the anime. Try again later.";
    //echo $mysqli->errno . ' ' . $mysqli->error;
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
        if (!empty($error)) {
            echo $error;
        } else {
            echo "Successfully Added " . $name . "!";
        }
        ?>
    </div>

</body>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>

</html>