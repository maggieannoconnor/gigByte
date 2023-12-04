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
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>Register</h2>
<form action="gigByteRegister.php" method="post">
    <label for="id">ID (Numeric 6-Digit Unique ID):</label>
    <input type="text" name="id" pattern="\d{6,}" title="Please enter a numeric ID with at least 6 digits" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="role">Role:</label>
    <select name="role">
        <option value="band_member">Band Member</option>
        <option value="venue_coordinator">Venue Coordinator</option>
    </select><br>

    <input type="submit" value="Next">
</form>

</body>
</html>
