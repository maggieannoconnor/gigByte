<!DOCTYPE html> 
<html lang="en">
<head> 
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Maggie O'Connor, Ethan Tran, and Robbie Boyle">
  <meta name="description" content="index page for gigByte">  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content {
      flex: 1;
    }
  </style>
</head>
<body>
  <?php include("header.php");?>

  <div class="content">
    <header class="jumbotron text-center">
      <?php
        require("connect-db.php");
        require("gigbyte-db.php");
        require("gigFunctions.php");
        session_start();

        if (isset($_SESSION["id"])) {
          $id = $_SESSION["id"];
          $query = "SELECT * FROM users WHERE id = :id";
          $statement = $db->prepare($query);
          $statement->bindValue(':id', $id);
          $success = $statement->execute();

          if (!$success) {
            echo "<p>Error executing query. Please try again later.</p>";
          } else {
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            if ($user) {
              echo "<p class='lead'>Welcome, " . $user['id'] . "!</p>";
              echo "<p>Your role: " . $user['role'] . "</p>";

              // Get role-specific attributes
              $roleAttributes = getRoleAttributes($user['role']);

              // Display user attributes, need to fix just shows N/A
              foreach ($roleAttributes as $attribute) {
                echo "<p>{$attribute}: " . ($user[$attribute] ?? 'N/A') . "</p>";
              }
            } else {
              echo "<p class='lead'>Welcome, Guest!</p>";
              echo "<p>No user found with ID: $id</p>";
            }
          }
        } else {
          echo "<p class='lead'>Welcome, Guest!</p>";
        }
      ?>
    </header>
  </div>

  <?php include("footer.html");?>   
</body>
</html>
