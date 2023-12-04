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
    <div class="container pt-3">
        <header class="jumbotron ">
            <?php
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];
                $userAttributes = getUserAttributes($id);

                if ($userAttributes !== false) {
                    echo "<p class='lead'><b>Welcome, {$userAttributes['id']}!</b></p>";
                    echo "<p>Your role: {$userAttributes['role']}</p>";

                    // Get role attributes
                    $roleAttributes = getRoleAttributes($userAttributes['role']);

                    // User 
                    foreach ($roleAttributes as $attribute) {
                        echo "<p>{$attribute}: " . ($userAttributes[$attribute] ?? 'N/A') . "</p>";
                    }

                    // Display Edit User Info Container only for logged-in users
                    ?>
                    <!-- Edit User Info Container -->

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
<br>
    <?php include("footer.html"); ?>
</body>
</html>
