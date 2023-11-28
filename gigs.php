<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_gig_info = getAllGigsInfo();

// Handle search functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = $_POST['search'];
    if (!empty($searchTerm)) {
        $list_of_gig_info = searchGigsByName($searchTerm);
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
    <h1 class="lead" style="text-align: center">Post A Gig</h1>
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