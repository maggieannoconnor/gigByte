<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_gig_info = getAllGigsInfo();
$all_venues = getAllVenues();
$open_gigs = getAllOpenGigs();
$filled_gigs = getAllFilledGigs();
$all_bands = getAllBands();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['gig']) && !empty($_POST['band'])) 
    {
        addBandToGig($_POST['band'], $_POST['gig']);
        $open_gigs = getAllOpenGigs();
        $filled_gigs = getAllFilledGigs();
    }
    elseif(!empty($_POST['removeGigBtn']))
    {
        removeBandFromGig($_POST['gigToRemove']);
        $open_gigs = getAllOpenGigs();
        $filled_gigs = getAllFilledGigs();
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
  <style>
        .rounded-box {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 40px;
            margin: 5px 0;
        }
    </style>
</head>

<body>
<?php include("header.php");?>

<div class="container"> 
    <h3 >Sign Up For A Gig</h3>
    <hr>
    <a class="btn" style="background-color: #232D4B; color:white;" href="gigs.php">Back to Gigs</a>
</div>

<h3 style="text-align: center;">Open Gigs:</h3>
<div class="row justify-content-center">
        <table class="table table-bordered table-card center" style="width:80%">
            <thead>
                <tr style="background-color: #232D4B; color:white;">
                    <th width="20%">Gig</th>
                    <th width="20%">Start Time</th>
                    <th width="20%">Venue</th>
                    <th width="25%">Address</th>
                    <th width="15%">Band</th>
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
<div class=" container center rounded-box mx-auto w-50">
<h2 style="text-align: center;">Sign Up</h2>
    <form action="gig-signup.php" method="post" style="text-align: center;">

        <label for="gig">Select a Gig:</label>
        <select id="gig" name="gig">
            <?php foreach($open_gigs as $gig):?>
                <option value="<?php echo $gig['gig_id']?>"><?php echo $gig['name']?></option>
            <?php endforeach;?>
        </select>

        <br>

        <label for="band">Select a Band:</label>
        <select id="band" name="band">
            <?php foreach($all_bands as $band):?>
                <option value="<?php echo $band['band_id']?>"><?php echo $band['name']?></option>
            <?php endforeach;?>
        </select>

        <br>
        <br>
        <input type="submit" class="btn" style="background-color: #232D4B; color:white;" value="Submit">

    </form>
</div>
<br>
<h3 style="text-align: center;"> Filled Gigs:</h3>
<div class="row justify-content-center">
        <table class="table table-bordered table-card center" style="width:80%">
            <thead>
                <tr style="background-color: #232D4B; color:white;">
                    <th width="20%">Gig</th>
                    <th width="20%">Start Time</th>
                    <th width="20%">Venue</th>
                    <th width="20%">Address</th>
                    <th width="20%">Band</th>
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filled_gigs as $gig):?>
                    <tr>
                        <td><?php echo $gig['gname']?></td>
                        <td><?php echo $gig['start_time']?></td>
                        <td><?php echo $gig['vname']?></td>
                        <td><?php echo $gig['address']?></td>
                        <td><?php echo $gig['bname']?></td>    
                        <td>
                            <form action="gig-signup.php" method="post">                           
                                <input type="submit" value="Remove" name="removeGigBtn" class="btn btn-danger" title="Delete Gig" />                           
                                <input type="hidden" name="gigToRemove" value="<?php echo $gig['gig_id']; ?>"/>
                            </form>
                        </td>              
                    </tr>   
                <?php endforeach;?>
            </tbody>
        </table>
</div>
<br>
<br>

<br>

</div>
<?php include("footer.html");?>   
</body>
</html>