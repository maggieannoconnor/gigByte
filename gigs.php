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
    if (!empty($searchTerm)) {
        $list_of_gig_info = searchGigsByName($searchTerm);
    }
    elseif(!empty($_POST['addGigBtn']))
    {
      
      addGig($_POST["gigName"], $_POST["startTime"], $_POST["endTime"], $_POST["venue"]);
      $list_of_gig_info = getAllGigsInfo();
    }
}
?>

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor and Robbie Boyle">
    <meta name="description" content="index page for gigByte">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include("header.html");?>
    <header class="jumbotron text-center">
        <h1>Open Gigs</h1>
    </header>


    <div class="container mb-3">
        <form action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by gig name/venue/address" name="search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:80%">
            <thead>
                <tr style="background-color:#B0A6B0">
                    <th width="20%">Gig</th>
                    <th width="20%">Start Time</th>
                    <th width="20%">Venue</th>
                    <th width="25%">Address</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_of_gig_info as $gig):?>
                    <tr>
                        <td><?php echo $gig['name']?></td>
                        <td><?php echo $gig['start_time']?></td>
                        <td><?php echo $gig['vname']?></td>
                        <td><?php echo $gig['address']?></td>
                        <td>
                            <input class="btn btn-info" type="submit" value="Sign Up">
                        </td>
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container mt-5">
    <h1 class="lead" style="text-align: center">Post A Gig</h1>
    <form action="gigs.php" method="post">
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

        <input type="submit" value="Add Gig" name="addGigBtn" class="btn btn-success" title="Add Gig" />
        <br>
    </form>
</div>

    <?php include("footer.html");?>   
</body>
</html>