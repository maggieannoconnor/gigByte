<?php
require("connect-db.php");
require("gigbyte-db.php");

$list_of_bands = getAllBands();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['confirmUpdateBtn'])) {
        updateBandById($_POST['id_to_update'], $_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
        $list_of_bands = getAllBands();
        header("Location: bands.php");
        exit();
    }
}

if (isset($_GET['band_id'])) {
    $band_id = $_GET['band_id'];
    $band_info = getBandById($band_id);
    echo "hi";
    echo $band_info;
    echo "hello";
    echo $band_info['name'];
} else {
    header("Location: bands.php");
    exit();
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
        <div class="flex-grow-1">
            <div class="container mt-4 form-section">
                
                <h3>Update Band</h3> 
                <hr>
                <form name="addBandForm" action="bands-update.php" method="post">   
                    <input type="hidden" name="id_to_update" value="<?php echo $band_id; ?>" />
                    <div class="row mb-3 mx-3">
                        Band Name (required):
                        <input type="text" class="form-control" name="bandname" value="<?php echo $band_info['name']; ?>"/>
                    </div>
                    <div class="row mb-3 mx-3">
                        Genre (required):
                        <input type="text" class="form-control" name="genre" value="<?php echo $band_info['genre']; ?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3">
                        Phone Number (required):
                        <input type="text" class="form-control" name="phone" value="<?php echo $band_info['phoneNumber']; ?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3">
                        Instagram Handle:
                        <input type="text" class="form-control" name="instagram" value="<?php echo $band_info['instagram']; ?>"/>        
                    </div>  
                    <div class="row mb-3 mx-3 form-buttons">
                        <input type="submit" value="Confirm Update" name="confirmUpdateBtn" class="btn btn-secondary" title="Update a band's information" required/>   
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