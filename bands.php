
<?php
require("connect-db.php");
require("gigbyte-db.php");
$list_of_bands = getAllBands();
if  ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if (!empty($_POST['updateBtn']))
  {
    //echo $_POST['id_to_update'];
  }
  elseif (!empty($_POST['insertBtn']))
  {
    addBand($_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
    $list_of_bands = getAllBands();
  }
  elseif (!empty($_POST['deleteBtn']))
  {
    deleteBand($_POST['id_to_delete']);
    $list_of_bands = getAllBands();
  }
  elseif(!empty($_POST['confirmUpdateBtn']))
  {
    updateBandById($_POST['bandname'], $_POST['genre'], $_POST['phone'], $_POST['instagram']);
    $list_of_bands = getAllBands();
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

   
</head>


<body>
<?php include("header.html");?>

<div class="container">

  <h1>All Bands</h1>  

<hr/>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="30%">Name        
    <th width="30%">Genre     
    <th width="30%">Instagram
    <th width="30%">Phone
    <th width="30%">Rating
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>

<?php foreach ($list_of_bands as $band): ?> 
  <tr> 
     <td><?php echo $band['name']; ?></td>
     <td><?php echo $band['genre']; ?></td>        
     <td><?php echo $band['instagram']; ?></td> 
     <td><?php echo $band['phoneNumber']; ?></td> 
     <td><?php echo $band['avg_rating'], "/5"; ?></td> 
     <td> 
        <form action="bands.php" method="post">
          <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary" />
          <input type="hidden" name="id_to_update" 
              value="<?php echo $band['band_id']; ?>"
          />
          <input type="hidden" name="name_to_update" 
              value="<?php echo $band['name']; ?>"
          />
          <input type="hidden" name="genre_to_update" 
              value="<?php echo $band['genre']; ?>"
          />
          <input type="hidden" name="instagram_to_update" 
              value="<?php echo $band['instagram']; ?>"
          />
          <input type="hidden" name="phone_to_update" 
              value="<?php echo $band['phoneNumber']; ?>"
          />
        </form>
      </td>   
     <td>
      <form action="bands.php" method="post">
        <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger" title="Remove a band" />
        <input type="hidden" name="id_to_delete" value="<?php echo $band['band_id'];?>"/>
      <form>
    </td>
  </tr>
<?php endforeach; ?>
</div>   
<br>

<div class="flex-grow-1">
  <div class="container mt-4">
<form name="addBandForm" action="bands.php" method="post">   
    <div class="row mb-3 mx-3">
      Band Name (required):
      <input type="text" class="form-control" name="bandname" value="<?php echo $_POST['name_to_update'];?>"/>
    </div><div class="row mb-3 mx-3">
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
    <div class="row mb-3 mx-3">
      <input type="submit" value="Add New Band" name="insertBtn" class="btn btn-primary" title="Insert a band into bands" />
    </div>
    <div class="row mb-3 mx-3">
      <input type="submit" value="Confirm Update" name="confirmUpdateBtn" 
              class="btn btn-secondary" title="Update a band's information" required/>   
    </div>  
</form>
  </div>
</div>
</table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  
</div>
<br>
<br>
<?php include("footer.html");?>   
</body>
</html>