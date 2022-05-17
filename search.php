<?php
require 'config/config.php';
//var_dump($_SESSION['logged_in']);
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
    <title>Search</title>
    <style>
        #searching {
            /* sbackground-color: pink; */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 80vh;
        }

        #above-text {
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 5%;
            font-size: 100%;
            /* display: none; */
        }

        body {
            background: rgb(174, 203, 252);
            background: radial-gradient(circle, rgba(174, 203, 252, 0.36207986612613796) 0%, rgba(211, 231, 247, 0.8018557764902836) 100%);
        }

        select option {
            display: block;
        }


        .input-field {
            color: #00695c;
        }

        p {
            color: darkgreen;
        }

        .submit-button {
            color: white !important;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="row" id="searching">
        <form action="index.php" method="GET" class="col s12 m12 l12">
            <div id="above-text">
                <p>What anime would you like to know something new about?</p>
            </div>
            <div class="form-group row">
                <div class="input-field col s10 m6 l4 offset-s1 offset-m3 offset-l4">
                    <input type="text" class="form-control" id="search-word" name="search-word">
                    <label for="search-word" class="col">Name:</label>
                </div>
            </div>
            <button class="waves-effect waves-light btn-small submit-button" type="submit">Submit
                <i class="material-icons right">send</i>
            </button>

        </form>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
        $(".button-collapse").sideNav();
    </script>

</body>

</html>