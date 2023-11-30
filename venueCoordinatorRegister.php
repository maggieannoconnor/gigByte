<?php
require("connect-db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_id = $_GET["id"];
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $title = $_POST["title"];
    $budget = $_POST["budget"];

    $query = "INSERT INTO venue_coordinator (account_id, name, phoneNumber, email, title, budget) 
              VALUES (:account_id, :name, :phoneNumber, :email, :title, :budget)";
    $statement = $db->prepare($query);
    $statement->bindValue(':account_id', $account_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':budget', $budget);
    $statement->execute();
    $statement->closeCursor();

    echo "Venue coordinator registration successful!";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Venue Coordinator Registration</title>
</head>
<body>

<h2>Venue Coordinator Registration</h2>
<form action="venueCoordinatorRegister.php?id=<?php echo $_GET['id']; ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="text" name="phoneNumber" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="title">Title:</label>
    <input type="text" name="title" required><br>

    <label for="budget">Budget:</label>
    <input type="text" name="budget" required><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
