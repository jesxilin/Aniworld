<?php
require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}

$sql = "SELECT favoriteanime.name, favoriteanime.description, studios.name AS studio, genres.name AS genre
FROM favoriteanime
LEFT JOIN genres
    ON favoriteanime.genres_idgenres = genres.idgenres
LEFT JOIN studios
    ON favoriteanime.studios_idstudios = studios.idstudios
ORDER BY favoriteanime.name ASC;";

$results = $mysqli->query($sql);
if (!$results) {
    echo $mysqli->query(($sql));
    exit();
}
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
    $hiddenMessage = "Did you know, you can edit any anime by clicking on their name?";
} else {
    $hiddenMessage = "";
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
    <style>
        table td {
            color: darkgreen;
        }

        table th {
            color: black;
        }

        body {
            background: rgb(219, 218, 252);
            background: radial-gradient(circle, rgba(219, 218, 252, 0.9951330874146533) 0%, rgba(206, 215, 207, 0.37608546836703427) 100%);
        }

        #hidden-message {
            color: black;
            font-size: 80%;
            padding-top: 1%;
            padding-right: 1%;
        }
    </style>
    <title>Picks</title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div id="hidden-message" class="right-align">
        <?php echo $hiddenMessage; ?>
    </div>
    <div id=“container">
        <!-- responsive-table -->
        <table class="">
            <thead>
                <tr>
                    <th>Anime</th>
                    <th>Description</th>
                    <th>Genres</th>
                    <th>Studio</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetch_assoc()) : ?>
                    <tr>
                        <td onclick="goEdit()"><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['genre']; ?></td>
                        <td><?php echo $row['studio']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav();
    </script>
    <script>
        $(document).ready(function() {
            $('select').formSelect();
        });

        function goEdit() {
            window.location.href = "edit.php"
        }
    </script>
</body>

</html>