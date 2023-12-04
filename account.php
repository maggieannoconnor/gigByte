<?php
require("connect-db.php");
require("gigbyte-db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateUserBtn'])) {
    $id = $_SESSION["id"];
    $userAttributes = getUserAttributes($id);

    if ($userAttributes !== false) {
        $name = $_POST['name'] ?? '';
        $phoneNumber = $_POST['phoneNumber'] ?? '';
        $email = $_POST['email'] ?? '';

        if ($userAttributes['role'] == 'band_member') {
            // Update band member table
            $instrument = $_POST['instrument'] ?? '';
            updateBandMember($id, $name, $phoneNumber, $email, $instrument);
        } elseif ($userAttributes['role'] == 'venue_coordinator') {
            // Update venue coordinator table
            $title = $_POST['title'] ?? '';
            $budget = $_POST['budget'] ?? '';
            updateVenueCoordinator($id, $name, $phoneNumber, $email, $title, $budget);
        }

        header("Location: account.php");
        exit();
    }
}
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
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .form-section {
            border: 1px solid black;
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            width: 50%;
            margin: auto;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
        }

        .form-buttons {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>

    <div class="content">
        <header class="jumbotron text-center">
            <?php
            if (isset($_SESSION["id"])) {
                $id = $_SESSION["id"];
                $userAttributes = getUserAttributes($id);

                if ($userAttributes !== false) {
                    echo "<p class='lead'>Welcome, {$userAttributes['id']}!</p>";
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
                    <div class="container form-section">
                        <h1 class="form-title">Edit User Info</h1>
                        <form name="editUserForm" action="account.php" method="post">
                            <div class="row mb-3 mx-3">
                                Name:
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo $userAttributes['name'] ?? ''; ?>" />
                            </div>
                            <div class="row mb-3 mx-3">
                                Phone Number:
                                <input type="text" class="form-control" name="phoneNumber"
                                    value="<?php echo $userAttributes['phoneNumber'] ?? ''; ?>" />
                            </div>
                            <div class="row mb-3 mx-3">
                                Email:
                                <input type="text" class="form-control" name="email"
                                    value="<?php echo $userAttributes['email'] ?? ''; ?>" />
                            </div>

                            <?php if ($userAttributes['role'] == 'band_member') : ?>
                                <div class="row mb-3 mx-3">
                                    Instrument:
                                    <input type="text" class="form-control" name="instrument"
                                        value="<?php echo $userAttributes['instrument'] ?? ''; ?>" />
                                </div>
                            <?php elseif ($userAttributes['role'] == 'venue_coordinator') : ?>
                                <div class="row mb-3 mx-3">
                                    Title:
                                    <input type="text" class="form-control" name="title"
                                        value="<?php echo $userAttributes['title'] ?? ''; ?>" />
                                </div>
                                <div class="row mb-3 mx-3">
                                    Budget:
                                    <input type="text" class="form-control" name="budget"
                                        value="<?php echo $userAttributes['budget'] ?? ''; ?>" />
                                </div>
                            <?php endif; ?>

                            <div class="form-buttons">
                                <button type="submit" class="btn btn-primary" name="updateUserBtn">Update User Info</button>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='lead'>Welcome, Guest!</p>";
                echo "<p class='lead'>Please sign in to see account information.</p>";
            }
            ?>
        </header>
    </div>

    <?php include("footer.html"); ?>
</body>

</html>
