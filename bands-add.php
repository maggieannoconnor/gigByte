<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handling different form submissions
    if (!empty($_POST['insertBtn'])) {
        addBand($_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
        $list_of_bands = getAllBands();
    } 
    header("Location: bands.php");
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
        <!-- Add A Band -->
        <div class="flex-grow-1">
            <div class="container mt-4 form-section">
                
                <h3>Add Band</h3> 
                <hr>
                <form name="addBandForm" action="bands-add.php" method="post">   
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
                    <br>
                    <br>
                    <div class="row mb-3 mx-3">
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <?php include("footer.html"); ?>
</body>
</html>