<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();
$list_of_band_members = getAllBandMembers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['band']) && !empty($_POST['band_member'])) {
        addBandMemberToBand(($_POST['band_member']), ($_POST['band']));
        $list_of_bands = getAllBands();
        $list_of_band_members = getAllBandMembers();
    } 
    elseif (!empty($_POST['band_to_remove']) && !empty($_POST['band_member_to_remove']))
    {
        removeBandMemberFromBand(($_POST['band_member_to_remove']), ($_POST['band_to_remove']));
        $list_of_bands = getAllBands();
        $list_of_band_members = getAllBandMembers();
    }
}

?>






<!DOCTYPE html> 
<html> 
<head> 

  <meta charset="UTF-8">  

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Maggie O'Connor and Robbie Boyle">
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


<h1 style="text-align: center">Band Members By Band</h1>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:80%">
    <thead>
        <tr style="background-color:#B0A6B0">
            <th width="20%">Band</th>
            <th width="20%">Instagram</th>
            <th width="50%">Members</th>
            
        </tr>
    </thead>
    <tbody>
        
        <?php foreach ($list_of_bands as $band):?>
            <tr>
                <td><?php echo $band['name']?></td>
                <td><?php echo $band['instagram']?></td>
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
<div class="rounded-box">
<h2 style="text-align: center;">Add Band Member To Band</h2>
<p style="text-align: center; text-decoration: underline;">Select Band and Member</p>
    <form action="" method="post" style="text-align: center;">

        <label for="band">Select a Band:</label>
        <select id="band" name="band">
            <?php foreach($list_of_bands as $band):?>
                <option value="<?php echo $band['band_id'];
                $currentBand = $band['band_id'];
                ?>">
                <?php echo $band['name']?>
            </option>
            <?php endforeach;?>
        </select>

        <br>

        <label for="band_member">Select a Member:</label>
        <select id="band_member" name="band_member">
            <?php foreach($list_of_band_members as $member):?>
                <option value="<?php echo $member['account_id']?>"><?php echo $member['name']?></option>
            <?php endforeach;?>
        </select>

        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>

<div class="rounded-box">
<h2 style="text-align: center;">Remove Band Member From Band</h2>
<p style="text-align: center; text-decoration: underline;">Select Band and Member</p>
    <form action="" method="post" style="text-align: center;">

        <label for="band_to_remove">Select a Band:</label>
        <select id="band_to_remove" name="band_to_remove">
            <?php foreach($list_of_bands as $band):?>
                <option value="<?php echo $band['band_id']?>"><?php echo $band['name']?></option>
            <?php endforeach;?>
        </select>

        <br>

        <label for="band_member_to_remove">Select a Member:</label>
        <select id="band_member_to_remove" name="band_member_to_remove">
            <?php foreach($list_of_band_members as $member):?>
                <option value="<?php echo $member['account_id']?>"><?php echo $member['name']?></option>
            <?php endforeach;?>
        </select>

        <br>
        <br>
        <input type="submit" class="btn btn-outline-danger" value="Remove">

    </form>
</div>


<br>
<br>
<br>
<br>
<br>
<?php include("footer.html");?>   
</body>
</html>
