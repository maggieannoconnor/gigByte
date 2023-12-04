<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handling different form submissions
    if (!empty($_POST['updateBtn'])) {
        // Process update
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
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Maggie O'Connor and Robbie Boyle">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php include("header.php"); ?>
        <div class="container">
            <h3 class="form-title">Bands</h3> 
            <hr>
            <?php foreach ($list_of_bands as $band): ?> 
                <div class="card d-flex mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #eef0f7 !important;" id="student_info_header">
                        <div class="me-auto p-2">
                            <h5 class="mb-0">
                                <?php echo $band['name']; ?>
                            </h5>
                        </div>

                        <div class="px-1">
                            <form action="bands.php" method="post">
                                <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary" />
                                <input type="hidden" name="id_to_update" value="<?php echo $band['band_id']; ?>" />
                                <input type="hidden" name="name_to_update" value="<?php echo $band['name']; ?>" />
                                <input type="hidden" name="genre_to_update" value="<?php echo $band['genre']; ?>" />
                                <input type="hidden" name="instagram_to_update" value="<?php echo $band['instagram']; ?>" />
                                <input type="hidden" name="phone_to_update" value="<?php echo $band['phoneNumber']; ?>" />
                            </form>
                        </div>

                        <div class="px-1">
                            <form action="bands.php" method="post">
                                <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger" title="Remove a band" />
                                <input type="hidden" name="id_to_delete" value="<?php echo $band['band_id']; ?>"/>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <p style="margin-right: 10px;" class="mb-0"><b>Genre: </b><?php echo $band['genre']; ?></p>
                                <p style="margin-right: 10px;" class="mb-0"><b>Instagram: </b><?php echo $band['instagram']; ?></p>
                                <p style="margin-right: 10px;" class="mb-0"><b>Phone: </b><?php echo $band['phoneNumber']; ?></p>
                                <p style="margin-right: 10px;" class="mb-0"><b>Rating: </b><?php echo $band['avg_rating'], "/5"; ?></p>
                            </div>

                            <div class="col">
                                <p style="margin-right: 10px;" class="mb-0"><b>Members: </b></p>
                                <?php
                                    $list_of_members = getMembersByBandID($band["band_id"]);
                                    if (!empty($list_of_members))
                                        foreach ($list_of_members as $member):
                                ?>
                                <p style="margin-right: 10px;" class="mb-0"><?php echo $member['name'];?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
`
  

        <!-- Add A Band -->
        <div class="flex-grow-1">
            <div class="container mt-4 form-section">
                
                <h3>Add Band</h3> 
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
                        <input type="submit" value="Add New Band" name="insertBtn" class="btn" style="background-color: #232D4B; color:white;" title="Insert a band into bands" />
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
    <?php include("footer.html"); ?>
</body>
</html>