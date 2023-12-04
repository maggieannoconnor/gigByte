<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_gig_info = getAllGigsInfo();
//$venue_coordinator_venues = getVenuesByCoordinatorId();
$all_venues = getAllVenues();

// Handle search functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo $_POST["venue"]."";
    $searchTerm = $_POST['search'];
    if(!empty($_POST['addGigBtn']))
    {
      
      addGig($_POST["gigName"], $_POST["startTime"], $_POST["endTime"], $_POST["venue"]);
      $list_of_gig_info = getAllGigsInfo();
    }
    header("Location: gigs.php");

}
?>

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor and Robbie Boyle">
    <meta name="description" content="">  
    <!--<script src="https://kit.fontawesome.com/4eb1de00b2.js" crossorigin="anonymous"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include("header.php");?>
    <div class="container">
    <h3 >Post A Gig</h3>
    <hr>
    <form action="gigs-add.php" method="post">
        <div class="mb-3">
            <label for="gigName" class="form-label">Gig Name:</label>
            <input type="text" class="form-control" id="gigName" name="gigName" required>
        </div>

        <div class="mb-3">
            <label for="startTime" class="form-label">Start Time:</label>
            <input type="datetime-local" class="form-control" id="startTime" name="startTime" required>
        </div>

        <div class="mb-3">
            <label for="endTime" class="form-label">End Time:</label>
            <input type="datetime-local" class="form-control" id="endTime" name="endTime" required>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue:</label>
            <select class="form-select" id="venue" name="venue" required>
                <option value="" disabled selected>Select a Venue</option>
                <?php foreach($all_venues as $venue): ?>
                  <option value="<?php echo $venue['venue_id']?>"> 
                    <?php echo $venue['name']?>
                  </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" value="Add Gig" name="addGigBtn" class="btn" style="background-color: #232D4B; color:white;" title="Add Gig" />
         
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </form>
</div>
    <?php include("footer.html");?>   
</body>
</html>