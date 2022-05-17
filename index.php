<?php
require 'config/config.php';
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
    <!-- CSS for specific page -->
    <style>
        #main {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 90vh;
            background-size: 100% 100%;
            z-index: 0;
            position: relative;
            bottom: 0;
        }


        body {
            background: rgb(219, 218, 252);
            background: radial-gradient(circle, rgba(219, 218, 252, 0.9951330874146533) 0%, rgba(206, 215, 207, 0.37608546836703427) 100%);
            background-size: cover;
            padding: 0;
            margin: 0;
            vertical-align: bottom;
            height: 100vh;
            color: white
        }

        #randomFact {
            text-align: center;
            max-width: 80%;
            font-size: 170%;
            opacity: 1;
            text-shadow: 2px 2px #1A4314;
            color: white;
        }
    </style>
    <title>Anime Quote</title>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div id="main">
        <!-- Where the random anime fact will display -->
        <p id="randomFact"></p>
        <!-- <div id="main-img"></div> -->
    </div>
    <div id="dom-target" style="display: none;">
        <?php
        if (empty($_GET['search-word'])) {
            $output = ""; // default value
        } else {
            $output = $_GET["search-word"];
        }
        echo $output;
        ?>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>