<?php
require 'config/config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
}
$sql = "SELECT * FROM genres ORDER BY name ASC;";
$results = $mysqli->query($sql);
if (!$results) {
    echo $mysqli->query(($sql));
    exit();
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
    <title>Add an Anime</title>
    <style>
        form {
            margin-top: 2%;
        }

        input {
            color: darkgreen;
        }

        i {
            color: #507958;
        }

        .submit-button {
            color: white !important;
        }

        body {
            background: rgb(174, 203, 252);
            background: radial-gradient(circle, rgba(174, 203, 252, 0.36207986612613796) 0%, rgba(211, 231, 247, 0.8018557764902836) 100%);
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="row">
        <form action="confirm_add.php" method="POST" class="col s12 m12 l12">
            <div class="row">
                <div class="input-field col s10 m6 l4 offset-s1 offset-m3 offset-l4">
                    <i class="material-icons prefix">live_tv</i>
                    <input id="icon_prefix" type="text" class="validate" name="anime" required>
                    <label for="icon_prefix">Anime</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 l4 offset-s1 offset-m3 offset-l4">
                    <select name="genre">
                        <option value="" disabled selected>Choose your option</option>
                        <?php while ($row = $results->fetch_assoc()) : ?>
                            <option value="<?php echo $row["idgenres"] ?>">
                                <?php echo $row["name"]; ?> </option>
                        <?php endwhile; ?>
                    </select>
                    <label>Genre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 l4 offset-s1 offset-m3 offset-l4">
                    <i class="material-icons prefix">videocam</i>
                    <input id="icon_prefix" type="text" class="validate" name="studio" required>
                    <label for="icon_prefix">Animation Studio:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m6 l4 offset-s1 offset-m3 offset-l4">
                    <i class="material-icons prefix">assignment</i>
                    <input id="icon_prefix" type="text" class="validate" name="desc" required>
                    <label for="icon_prefix">Description in a few words:</label>
                </div>
            </div>
            <div class="center-align">
                <button class="waves-effect waves-light btn-small submit-button" type="submit">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>

</body>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script>
    $(document).ready(function() {
        $('select').formSelect();
    });
</script>

</html>