<?php
session_start();

// Check if the signout form is submitted
if (isset($_POST["signout"])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login.php
    header("Location: login.php");
    exit();
}
?>
<header>  
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container-fluid">            
        <a class="navbar-brand" href="index.php">GigByte</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="bands.php">Bands</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="band-members.php">Band Members</a>
            </li>           
            <li class="nav-item dropdown">
              <a class="nav-link" href="gigs.php">Gigs</a>
            <li class="nav-item dropdown">
              <a class="nav-link" href="venues.php">Venues</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="account.php">Account</a>
            </li>
            <li class="nav-item">
                <?php
                // Check if the user is logged in
                if (isset($_SESSION["id"])) {
                    echo '<li class="nav-item">
                            <form class="nav-link" method="post" action="index.php">
                                <input type="submit" name="signout" value="Sign Out" class="btn btn-link">
                            </form>
                        </li>';
                } else {
                    echo '<li class="nav-item d-none d-md-block"><a class="nav-link" href="login.php">Login</a></li>';
                }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header> 