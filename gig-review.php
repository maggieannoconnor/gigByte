<?php
require("connect-db.php");
require("gigbyte-db.php");

$all_reviews = getAllReviews();
$all_bands = getAllBands();
$sorted_bands = getAllSortedBands();
$all_gigs = getAllGigsInfo();
$all_venue_coordinators = getAllVenueCoordinators();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['band']) && !empty($_POST['gig']) && !empty($_POST['venue_coordinator']) && !empty($_POST['rating']) && !empty($_POST['comment'])){
        addReview( $_POST['venue_coordinator'], $_POST['band'], $_POST['gig'], $_POST['rating'], $_POST['comment']);

        foreach($all_bands as $bands) {
            updateAverageRating($bands["band_id"]);
        }
        $all_reviews = getAllReviews();
        $all_bands = getAllBands();
    }
}

foreach($all_bands as $bands) {
    updateAverageRating($bands["band_id"]);
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
<?php include("header.php");?>

<div class="container"> 
<header class="jumbotron text-center">
    <h2 class="display-4">Reviews</h2>
    <p class="lead">See Reviews From Previous Gigs</p>
</header>
<div class="container mb-3" style="text-align: left">
    <a class="btn btn-danger" href="gigs.php">Back to Gigs</a>
</div>

<div class="row justify-content-center">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:90%">
            <thead>
                <tr style="background-color:#B0A6B0">
                    <th width="15%">Band</th>
                    <th width="15%">Rating</th>
                    <th width="40%">Review</th>
                    <th width="15%">Gig</th>
                    <th width="15%">Reviewer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($all_reviews as $review):?>
                    <tr>
                        <td><?php echo $review['bname']?></td>
                        <td><?php echo $review['Rating']?></td>
                        <td><?php echo $review['Comments']?></td>
                        <td><?php echo $review['gname']?></td>
                        <td><?php echo $review['vname']?></td>
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
</div>



<br>
<div class="row justify-content-left">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:50%">
            <h4 style="text-align: justify;">Band Ratings</h4>
            <thead>
                <tr style="background-color:#B0A6B0">
                    <th width="50%">Band</th>
                    <th width="50%">Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sorted_bands as $band):?>
                    <tr>
                        <td><?php echo $band['name']?></td>
                        <td><?php 
                            //updateAverageRating($band['band_id']);
                            echo $band['avg_rating'];
                        ?></td>
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
</div>
<div class="row justify-content-center">
    <div class="rounded-box p-4">
        <form action="gig-review.php" method="post" class="w-75 mx-auto">
            <h4 class="text-center mb-4">Add a Review</h4>

            <div class="mb-3">
                <label for="band" class="form-label">Select a Band:</label>
                <select id="band" name="band" class="form-select">
                    <?php foreach($all_bands as $band):?>
                        <option value="<?php echo $band['band_id']?>"><?php echo $band['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="mb-3">
                <label for="gig" class="form-label">Select a Gig:</label>
                <select id="gig" name="gig" class="form-select">
                    <?php foreach($all_gigs as $gig):?>
                        <option value="<?php echo $gig['gig_id']?>"><?php echo $gig['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="mb-3">
                <label for="venue_coordinator" class="form-label">Select a Venue Coordinator:</label>
                <select id="venue_coordinator" name="venue_coordinator" class="form-select">
                    <?php foreach($all_venue_coordinators as $coordinator):?>
                        <option value="<?php echo $coordinator['account_id']?>"><?php echo $coordinator['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Add a Decimal Number (Rating 1-5):</label>
                <input type="number" step="0.1" id="rating" name="rating" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Add a Text Comment:</label>
                <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>
            </div>

            <div class="text-center">
                <input type="submit" value="Submit Review" class="btn btn-primary">
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


<?php include("footer.html");?>   
</body>
</html>