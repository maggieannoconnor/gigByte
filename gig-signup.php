<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_gig_info = getAllGigsInfo();
$all_venues = getAllVenues();
$open_gigs = getAllOpenGigs();
$filled_gigs = getAllFilledGigs();

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

<div class="container"> 
<header class="jumbotron text-center">
    <h1 class="display-4">Sign Up For A Gig</h1>

</header>
<div class="container mb-3" style="text-align: left">
    <a class="btn btn-danger" href="gigs.php">Back to Gigs</a>
</div>


<h3 style="text-align: center;">Open Gigs:</h3>
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
                <?php foreach ($open_gigs as $gig):?>
                    <tr>
                        <td><?php echo $gig['name']?></td>
                        <td><?php echo $gig['start_time']?></td>
                        <td><?php echo $gig['vname']?></td>
                        <td><?php echo $gig['address']?></td>                   
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
</div>
    
<br>
<br>
<br>
<h3 style="text-align: center;"> Filled Gigs:</h3>
<div class="row justify-content-center">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:80%">
            <thead>
                <tr style="background-color:#B0A6B0">
                    <th width="20%">Gig</th>
                    <th width="20%">Start Time</th>
                    <th width="20%">Band</th>
                    <th width="20%">Venue</th>
                    <th width="20%">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filled_gigs as $gig):?>
                    <tr>
                        <td><?php echo $gig['gname']?></td>
                        <td><?php echo $gig['start_time']?></td>
                        <td><?php echo $gig['bname']?></td>
                        <td><?php echo $gig['vname']?></td>
                        <td><?php echo $gig['address']?></td>                   
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
</div>
<br>
<br>

<br>


<?php include("footer.html");?>   
</body>
</html>