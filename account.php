<?php
require("connect-db.php");
require("gigbyte-db.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor, Ethan Tran, and Robbie Boyle">
    <meta name="description" content="index page for gigByte">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container pt-2">
        <header class="jumbotron ">
            <?php
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];
                $userAttributes = getUserAttributes($id);

                if ($userAttributes !== false) {
                    echo "<h3>Welcome, {$userAttributes['id']}!</h3>";


                    // Display Edit User Info Container only for logged-in users
                    ?>
                    <!-- Edit User Info Container -->
                    <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Your role:</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $userAttributes['role'];?></p>
              </div>
            </div>
            <hr>
            <?php
            $roleAttributes = getRoleAttributes($userAttributes['role']);
            foreach ($roleAttributes as $attribute) {
                ?>
                <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0"><?php echo $attribute;?>:</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $userAttributes[$attribute];?></p>
                </div>
                </div>
                <hr>
                <?php
            }
            ?>
          </div>
        </div>
                    <a href="account-edit.php" class="btn" style="background-color: #232D4B; color:white;" role="button" name="gotoupdateUserBtn">
                        Update
                    </a>
                    </div>
                    <?php
                }
            } 
            else {
                echo "<p class='lead'>Welcome, Guest!</p>";
                echo "<p class='lead'>Please sign in to see account information.</p>";
            }
            ?>
        </header>
    <br>
    <div class="container">
    
        </div>
        </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <?php include("footer.html"); ?>
</body>
</html>
