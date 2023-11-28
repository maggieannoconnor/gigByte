<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();
$list_of_band_members = getAllBandMembers();

?>






<!DOCTYPE html> 
<html> 
<head> 

  <meta charset="UTF-8">  

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Maggie O'Connor and Robbie Boyle">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   
</head>


<body>
<?php include("header.html");?>


<h1 style="text-align: center">Band Members By Band</h1>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:80%">
    <thead>
        <tr style="background-color:#B0A6B0">
            <th width="20%">Band</th>
            <th width="70%">Members</th>
            
        </tr>
    </thead>
    <tbody>
        
        <?php foreach ($list_of_bands as $band):?>
            <tr>
                <td><?php echo $band['name']?></td>
                <td>
                <?php echo "| "?>
                <?php 
                    $list_of_members = getMembersByBandID($band["band_id"]);
                    foreach ($list_of_members as $member):
                ?>
                
                <?php echo $member['name']." on ".$member['instrument']." | "?>
                <?php endforeach; ?>
                </td>
            </tr>   
        <?php endforeach;?>
        
    </tbody>
    <hr>
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
<?php include("footer.html");?>   
</body>
</html>
