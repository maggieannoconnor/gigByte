<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require("connect-db.php");
require("gigbyte-db.php");

// To list out all venues
$list_of_venues = getAllVenues();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['actionBtn'])) {
        addVenue($_POST['name'], $_POST['address']);
        $list_of_venues = getAllVenues(); // name, address
    }
    header("Location: venues.php");
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
    <h3>Add Venue</h3>
    <hr />
    <form name="mainForm" action="venues-add.php" method="post">
        <input type="hidden" class="form-control" name="venue_id" required
            value="<?php echo $_POST['venueid_to_update']; ?>" />
        <div class="row mb-3 mx-2">
            Venue Name:
            <input type="text" class="form-control" name="name" required
                value="<?php echo $_POST['venuename_to_update']; ?>" />
        </div>
        <div class="row mb-3 mx-2">
            Address:
            <input type="text" class="form-control" name="address" required
                value="<?php echo $_POST['venueaddress_to_update']; ?>" />
        </div>
        <div class="row mb-3 mx-2" >
            <input type="submit" value="Add Venue" name="actionBtn" class="btn" style="background-color: #232D4B; color:white;"
                title="Insert a venue into venue" required />
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
    <br>
    <br>
    <br>
    <br>
    <?php include("footer.html"); ?>
</body>

</html>
