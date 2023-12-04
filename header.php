<?php
session_start();

// Check if the signout form is submitted
if (isset($_POST["signout"])) {
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login.php
    header("Location: login.php");
    exit();
}
?>
<header class="site-header sticky-top" style="margin-bottom: 10px"> 
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #232D4B;">
      <div class="container-fluid">            
        <a class="navbar-brand p-1" href="index.php">
          <!-- <img src="https://i1.wp.com/ajaylimaye.com/wp-content/uploads/2019/06/1024px-University_of_Virginia_Rotunda_logo.svg_.png?fit=686%2C700&ssl=1" alt="UVA LOGO" width="30" height="30">
          -->
          GigByte
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ms-auto">
              <?php
                    if (isset($_SESSION["id"])) {
                        // User is logged in, all links
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link" href="bands.php">Bands</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="band-members.php">Band Members</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="gigs.php">Gigs</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="venues.php">Venues</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="account.php">Account</a>
                            </li>
                            <li class="nav-item">
                                <form method="post" action="index.php">
                                    <input type="submit" name="signout" value="Sign Out" class="btn btn-link nav-link">
                                </form>
                            </li>';
                    } else {
                        // User is not logged in
                        echo '<li class="nav-item d-none d-md-block"><a class="nav-link" href="login.php">Login</a></li>';
                    }
                    ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header> 