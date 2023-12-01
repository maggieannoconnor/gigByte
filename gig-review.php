<?php
require("connect-db.php");
require("gigbyte-db.php");

$all_reviews = getAllReviews();



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
<br>
<br>


<?php include("footer.html");?>   
</body>
</html>