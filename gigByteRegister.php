<?php
require("connect-db.php");

// Check if the user is already logged in
session_start();
if (isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Security sanitization for ID
    if (!is_numeric($id) || strlen($id) < 6) {
        echo "Invalid ID. Please enter a numeric ID with at least 6 digits.";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (id, password, role) VALUES (:id, :password, :role)";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':password', $hashedPassword);
    $statement->bindValue(':role', $role);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to role-specific form
    if ($role === "band_member") {
        header("Location: bandMemberRegister.php?id=$id");
        exit();
    } elseif ($role === "venue_coordinator") {
        header("Location: venueCoordinatorRegister.php?id=$id");
        exit();
    } else {
        echo "Invalid role.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Register</h2>
        <form action="gigByteRegister.php" method="post">

            <div class="form-group">
                <label for="id">ID (Numeric 6-Digit Unique ID):</label>
                <input type="text" class="form-control" name="id" pattern="\d{6,}" title="Please enter a numeric ID with at least 6 digits" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role">
                    <option value="band_member">Band Member</option>
                    <option value="venue_coordinator">Venue Coordinator</option>
                </select>
            </div>

            <button type="submit" class="btn" style="background-color: #232D4B; color:white">Next</button>
        </form>
    </div>
</div>

<img src="gigbyte-icon.jpg" width="300" height="300">


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

