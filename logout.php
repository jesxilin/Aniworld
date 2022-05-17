<?php
require 'config/config.php';
if ($_SESSION['logged_in']) {
    // log user out 
    $_SESSION['logged_in'] = false;
    //redirect user to index page 
    header("Location: index.php");
    //session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
</head>

<body>

</body>

</html>