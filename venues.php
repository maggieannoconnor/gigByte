<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require("connect-db.php");
require("gigbyte-db.php");

// To list out all venues
$list_of_venues = getAllVenues();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['updateBtn'])) {
        //echo $_POST['venuename_to_update'];
    } else if (!empty($_POST['confirmUpdateBtn'])) {
        updateVenue($_POST['venue_id'], $_POST['name'], $_POST['address']);
        $list_of_venues = getAllVenues();
    } else if (!empty($_POST['deleteBtn'])) {
        deleteVenue($_POST['venueid_to_delete']);
        $list_of_venues = getAllVenues();
    } else if (!empty($_POST['actionBtn'])) {
        addVenue($_POST['name'], $_POST['address']);
        $list_of_venues = getAllVenues(); // name, address
    }
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
        <h3>Venues</h3>
        <hr />
        <?php foreach ($list_of_venues as $venue): ?>
        <div class="card d-flex mb-3">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #eef0f7 !important;" id="student_info_header">
                <div class="me-auto p-1">
                    <h5 class="mb-0">
                        <?php echo $venue['name']; ?>
                    </h5>
                </div>

                <div class="px-1">
                    <form action="venues.php" method="post">
                        <input type="submit" value="Update" name="updateBtn" class="btn-sm btn-secondary mr-2" />
                        <!--pass in all information that could be updated-->
                        <input type="hidden" name="venueid_to_update"
                            value="<?php echo $venue['venue_id']; ?>" />
                        <input type="hidden" name="venuename_to_update"
                            value="<?php echo $venue['name']; ?>" />
                        <input type="hidden" name="venueaddress_to_update"
                            value="<?php echo $venue['address']; ?>" />
                    </form>
                </div>

                <div class="px-1">
                    <form action="venues.php" method="post">
                        <input type="submit" value="Delete" name="deleteBtn" class="btn-sm btn-danger" />
                        <input type="hidden" name="venueid_to_delete"
                            value="<?php echo $venue['venue_id']; ?>" />
                    </form>
                </div>

            </div>
            <div class="card-body">
              <p style="margin-right: 10px;" class="mb-0"><b>Address: </b><?php echo $venue['address']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
<br>
<br>
<br>
    <h3>Add Venue</h3>
    <form name="mainForm" action="venues.php" method="post">
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
        <div class="row mb-3 mx-2">
            <input type="submit" value="Confirm Update" name="confirmUpdateBtn" class="btn btn-secondary"
                title="Update a venues's information" required />
        </div>
    </form>
    </div>
    </div>
    <?php include("footer.html"); ?>
</body>

</html>
