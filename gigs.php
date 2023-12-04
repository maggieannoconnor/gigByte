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
    if (!empty($searchTerm)) 
    {
        $list_of_gig_info = searchGigsByName($searchTerm);
    }
    elseif (!empty($_POST['deleteGigBtn'])) 
    {
        deleteGig($_POST['gigIdToDelete']);
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
    <meta name="description" content="">  
    <!--<script src="https://kit.fontawesome.com/4eb1de00b2.js" crossorigin="anonymous"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php include("header.php");?>
    <div class="container">
    <h3 >Gigs</h3>
    <hr>
    <a href="gigs-add.php" class="btn" style="background-color: #232D4B; color:white;" role="button" name="addgigbutton">
        Post A Gig
    </a>
    <br>
    <br>
    </div>

    <div class="container mb-3">
        <form action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by gig name/venue/address" name="search">
                <button class="btn" style="background-color: #232D4B; color:white;" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">  
        <table class="table table-bordered table-card center" style="width:80%">
            <thead>
                <tr style="background-color: #232D4B; color:white;">
                    <th width="20%">Gig</th>
                    <th width="20%">Start Time</th>
                    <th width="20%">Venue</th>
                    <th width="32%">Address</th>
                    <th width="8%"></th>
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
                            <form action="gigs.php" method="post">
                                
                                <input type="submit" value="Delete" name="deleteGigBtn" class="btn btn-danger" title="Delete Gig" />                           
                                <input type="hidden" name="gigIdToDelete" value="<?php echo $gig['gig_id']; ?>"/>
                            </form>
                        </td>
                        
 
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <br>
    <div class="container mb-3" style="text-align: center">
        <a class="btn" style="background-color: #232D4B; color:white;" href="gig-signup.php">Sign Up For A Gig!</a>
    </div>
    <div class="container mb-3" style="text-align: center">
        <a class="btn" style="background-color: #232D4B; color:white;" href="gig-review.php">See Band Reviews</a>
    </div>
    <br>
</div>
    <?php include("footer.html");?>   
</body>
</html>