<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require("connect-db.php");
require("gigbyte-db.php");

// To list out all venues
$list_of_venues = getAllVenues();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['confirmUpdateBtn'])) {
        updateVenue($_POST['id_to_update'], $_POST['name'], $_POST['address']);
        $list_of_venues = getAllVenues();
        header("Location: venues.php");
        exit();
    } 
}

if (isset($_GET['venue_id'])) {
    $venue_id = $_GET['venue_id'];
    $venue_info = getVenueById($venue_id);
} else {
    header("Location: venues.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor">
    <meta name="description" content="List of Venues for GigByte">
    <title>GigByte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--icon displayed in browzer tab, important for usability!!-->
    <!-- If you choose to use a favicon, specify the destination of the resource in href -->
    <!-- <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" /> -->
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container">
    <h3>Update Venue</h3>
    <hr>
    <form name="mainForm" action="venues-update.php" method="post">
        <input type="hidden" name="id_to_update" value="<?php echo $venue_id; ?>" />
        <div class="row mb-3 mx-2">
            Venue Name:
            <input type="text" class="form-control" name="name" required
                value="<?php echo $venue_info['name']; ?>" />
        </div>
        <div class="row mb-3 mx-2">
            Address:
            <input type="text" class="form-control" name="address" required
                value="<?php echo $venue_info['address']; ?>" />
        </div>
        <div class="row mb-3 mx-2">
            <input type="submit" value="Confirm Update" name="confirmUpdateBtn" class="btn" style="background-color: #232D4B; color:white;"
                title="Update a venues's information" required />
        </div>
    </form>
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
    <?php include("footer.html"); ?>
</body>

</html>
