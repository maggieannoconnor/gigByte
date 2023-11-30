<?php
require("connect-db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $instrument = $_POST["instrument"];

    $query = "INSERT INTO band_member (account_id, name, phoneNumber, email, instrument) 
              VALUES (:id, :name, :phoneNumber, :email, :instrument)";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':instrument', $instrument);
    $statement->execute();
    $statement->closeCursor();

    echo "Band member registration successful!";
    header("Location: login.php");
    echo "Congrats you have sucesfully created an account, please log in now";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Band Member Registration</title>
</head>
<body>

<h2>Band Member Registration</h2>
<form action="bandMemberRegister.php?id=<?php echo $_GET["id"]; ?>" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="phoneNumber">Phone Number:</label>
    <input type="text" name="phoneNumber" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="instrument">Instrument:</label>
    <input type="text" name="instrument" required><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
