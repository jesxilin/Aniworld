<nav class="nav-extended navigation">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">Aniworld</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <li><a href="picks.php">Everyone's Picks</a></li>
            <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php else : ?>
                <li><a href="add.php">Add Anime</a></li>
                <li><a href="delete.php">Delete Anime</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="logout.php">Log Out<a></li>
            <?php endif; ?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Home</a></li>
            <li><a href="picks.php">Everyone's Picks</a></li>
            <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) : ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php else : ?>
                <li><a href="add.php">Add Anime</a></li>
                <li><a href="delete.php">Delete Anime</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="logout.php">Log Out<a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>