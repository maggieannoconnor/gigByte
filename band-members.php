<?php
require("connect-db.php");
require("gigbyte-db.php");

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
