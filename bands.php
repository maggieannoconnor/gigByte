<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['updateBtn'])) {
        //echo $_POST['id_to_update'];
    } elseif (!empty($_POST['insertBtn'])) {
        addBand($_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
        $list_of_bands = getAllBands();
    } elseif (!empty($_POST['deleteBtn'])) {
        deleteBand($_POST['id_to_delete']);
        $list_of_bands = getAllBands();
    } elseif (!empty($_POST['confirmUpdateBtn'])) {
        updateBandById($_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
        $list_of_bands = getAllBands();
    }
}
/*
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $list_of_bands = getAllBands();
  $string = $_GET['filter'];
  echo $string;
  if(!empty($string)) {
    echo ($string);
    $list_of_bands = performBandSearch($string);
  } else {
    
  }
  //echo $list_of_bands;
}
*/
?>

<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor and Robbie Boyle">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .center {
            margin: auto;
        }
        .table-header {
            background-color: #B0A6B0;
        }
        .form-section {
            border: 1px solid black;
            text-align: center;
        }
        .form-title {
            text-align: center;
        }
        .form-buttons {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include("header.php");?>
    <br>
    <div class="container">
        <div class="row mb-3 mx-3 form-section">
            <h1 class="form-title">All Bands</h1> 
        </div>  
        <hr/>
        <div class="row justify-content-center">  
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                <thead>
                    <tr class="table-header">
                        <th width="20%">Name</th>
                        <th width="20%">Genre</th>
                        <th width="20%">Instagram</th>
                        <th width="20%">Phone</th>
                        <th width="20%">Rating</th>
                        <th width="50%">Members</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <?php foreach ($list_of_bands as $band): ?> 
                    <tr style="border: 1px solid black"> 
                        <td><?php echo $band['name']; ?></td>
                        <td><?php echo $band['genre']; ?></td>        
                        <td><?php echo $band['instagram']; ?></td> 
                        <td><?php echo $band['phoneNumber']; ?></td> 
                        <td><?php echo $band['avg_rating'], "/5"; ?></td> 
                        <td>
                            <?php
                            $list_of_members = getMembersByBandID($band["band_id"]);
                            if (!empty($list_of_members))
                                foreach ($list_of_members as $member):
                                    echo ($member['name']." ");
                                endforeach;
                            ?>
                        </td>
                        <td> 
                            <form action="bands.php" method="post">
                                <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary" />
                                <input type="hidden" name="id_to_update" value="<?php echo $band['band_id']; ?>" />
                                <input type="hidden" name="name_to_update" value="<?php echo $band['name']; ?>" />
                                <input type="hidden" name="genre_to_update" value="<?php echo $band['genre']; ?>" />
                                <input type="hidden" name="instagram_to_update" value="<?php echo $band['instagram']; ?>" />
                                <input type="hidden" name="phone_to_update" value="<?php echo $band['phoneNumber']; ?>" />
                            </form>
                        </td>   
                        <td>
                            <form action="bands.php" method="post">
                                <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger" title="Remove a band" />
                                <input type="hidden" name="id_to_delete" value="<?php echo $band['band_id']; ?>"/>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>   
        <br>
        <hr>
        <div class="flex-grow-1">
            <div class="container mt-4 form-section">
                <div class="row mb-3 mx-3">
                    <h1 class="form-title">Add A Band</h1> 
                </div>  
                <hr>
                <form name="addBandForm" action="bands.php" method="post">   
                    <div class="row mb-3 mx-3">
                        Band Name (required):
                        <input type="text" class="form-control" name="bandname" value="<?php echo $_POST['name_to_update'];?>"/>
                    </div>
                    <div class="row mb-3 mx-3">
                        Genre (required):
                        <input type="text" class="form-control" name="genre" value="<?php echo $_POST['genre_to_update'];?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3">
                        Phone Number (required):
                        <input type="text" class="form-control" name="phone" value="<?php echo $_POST['phone_to_update'];?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3">
                        Instagram Handle:
                        <input type="text" class="form-control" name="instagram" value="<?php echo $_POST['instagram_to_update'];?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3 form-buttons">
                        <input type="submit" value="Add New Band" name="insertBtn" class="btn btn-primary" title="Insert a band into bands" />
                    </div>
                    <div class="row mb-3 mx-3 form-buttons">
                        <input type="submit" value="Confirm Update" name="confirmUpdateBtn" class="btn btn-secondary" title="Update a band's information" required/>   
                    </div>  
                    <br>
                    <br>
                    <div class="row mb-3 mx-3">
                        <!--
                        <form method="get" action="bands.php">
                            <input type="text" name="filter" placeholder="search for a band here">
                            <button type="submit">Search</button>
                        </form>
                        -->
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>