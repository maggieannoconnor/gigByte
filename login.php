<?php
require("connect-db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if ($user && password_verify($password, $user["password"])) {
        session_start();
        $_SESSION["id"] = $user["id"];
        $_SESSION["role"] = $user["role"];

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<h2>Login</h2>
<form action="login.php" method="post">
    <label for="id">ID:</label>
    <input type="text" name="id" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<p>Don't have an account? <a href="gigByteRegister.php">Create an account</a>.</p>

</body>
</html>


