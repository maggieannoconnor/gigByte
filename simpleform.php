<!-- put php connection at top because you don't want user to be able to do anything with the page or form unless DB connected
can do this in other file (this example) or directly in this file-->
<?php
// interpretter go grabs this file and grabs results and dumps here
// something goes wrong, then it terminates immediately
require("connect-db.php");
// kind of does the same thing, but still proceeds if something goes wrong-->
// include("connect-db.php"); -->

// make available to use in code
require("gigbyte-db.php");
// so list shows when you first open site
$list_of_friends = getAllFriends();
if  ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['updateBtn']))
  {
    echo $_POST['friendname_to_update'];
  }
  else if (!empty($_POST['confirmUpdateBtn'])){
    updateFriendByName($_POST['friendname'], $_POST['major'], $_POST['year']);
    $list_of_friends = getAllFriends();
  }
  else if (!empty($_POST['deleteBtn'])){
    deleteFriend($_POST['friendname_to_delete']);
    $list_of_friends = getAllFriends();
  }
  else if (!empty($_POST['actionBtn']))
  {
    addFriend($_POST['friendname'], $_POST['major'], $_POST['year']);
    $list_of_friends = getAllFriends(); // name, major, year
    // var_dump($list_of_friends);
  }
}
?>


<!-- 1. create HTML5 doctype -->
<!DOCTYPE html> <!-- tell browzer to use latest version of html-->
<html> <!-- tell bowneries of whole docutment-->
<head> <!-- tell browzer how to render things-->
  <!-- not really displayed on screen, just important info and surrounding things like browzer bar-->
  <meta charset="UTF-8">  <!-- what charavters for browzer to use-->
  
  <!-- screen size and responsiveness-->
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <!-- author for code ownership-->
  <meta name="author" content="Maggie O'Connor">

  <!-- meaningful key words for usability
  in google shearch, if user's search words match your key words, your website will be more reccomended
  you want your page to be higher in search results so meaningful words are important
  if interested, check 'search optimizer' to see how to make your page more reccomended in search results-->
  <meta name="description" content="include some description about your page">  
  
  <!--displayed in browzer tab-->
  <title>Bootstrap example</title>
  
  <!-- 3. link bootstrap -->
  <!-- add bootstrap so you have template and don't have to do everything from scrathc
  and then go in and customize-->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <!-- can change if you want a different version-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!--icon displayed in browzer tab, important for usability!!-->
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<!--actual content displayed on screen
body tags tell bodries of what is displayed on screen
any content goes here-->
<body>
<?php include("header.html");?>

<div class="container"> <!-- specified bootstrap format 
  (adds cushion, default font, etc.) - make use of existing bootstrap format -->
  <h1>DB Programming: Get Started</h1>  

  <!-- <a href="simpleform.php">Click to open the next page</a> -->

  <!-- form - where user interacts with application -->
  <!--tells boundries where user can interact-->
  <form name="mainForm" action="simpleform.php" method="post">   
  <!-- <form name="mainForm" action="form-processing.php" method="post"> -->
    <!-- name allows back end programer to refer back to which part of the screen
    action="" specifies where to send data 
      in this case, when action="form-processing.php", you will be taken to another page called form-processing.php that specifies how the form information is displayed
    method="" specifies how data should be sent to server
      get - attach all form data to URL so it is visible to world (okay if not confidential) and also limits size of data, so will cut off extra characters
      post - reccomended especially if entering username or password. Puts all form data in object and sends to server, so nothing in URL
    -->
    <div class="row mb-3 mx-3"> <!-- boostrap format -->
      Your name:
      <input type="text" class="form-control" name="friendname" required 
          value="<?php echo $_POST['friendname_to_update'];?>"
      /> <!--inputbox--> 
      <!-- type="text" means typical text box -->   
      <!-- name="" what to refer to this box for when someone tries to submit the form we can come back and get information-->
    </div><div class="row mb-3 mx-3">
      Major:
      <input type="text" class="form-control" name="major" required 
          value="<?php echo $_POST['major_to_update'];?>"
      />        
    </div>  
    <div class="row mb-3 mx-3">
      Year:
      <input type="text" class="form-control" name="year" required
         value="<?php echo $_POST['year_to_update'];?>"
      />        
    </div>  
    <div class="row mb-3 mx-3">
      <!-- button
      when user clicks button, it submits form and grabs data
      -->
      <input type="submit" value="Add Friend" name="actionBtn" 
              class="btn btn-primary" title="Insert a friend into friends" required />   
      <!-- value="" is label on button
      name="" to refer back to form
      title="" allow software to read what this content on the screen is about, for usability (ex. blind)-->     
      <!-- check out '508 compliance' for more usuability/ux/ui for standard minimal requirements for accesability -->
    </div>  
    <div class="row mb-3 mx-3">
      <input type="submit" value="Confirm Update" name="confirmUpdateBtn" 
              class="btn btn-secondary" title="Update a friend's information" required />   
    </div>  
  </form> 

<hr/>
<h3>List of Friends</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0A6B0">
    <th width="30%">Name        
    <th width="30%">Major        
    <th width="30%">Year 
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>

<?php foreach ($list_of_friends as $friend): ?> 
  <tr>  <!-- each row --> 
     <td><?php echo $friend['name']; ?></td> <!-- each column --> 
     <td><?php echo $friend['major']; ?></td>        
     <td><?php echo $friend['year']; ?></td> 
     <td> 
        <form action="simpleform.php" method="post">
          <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary" />
          <!--pass in all information that could be updated-->
          <input type="hidden" name="friendname_to_update" 
              value="<?php echo $friend['name']; ?>"
          />
          <input type="hidden" name="major_to_update" 
              value="<?php echo $friend['major']; ?>"
          />
          <input type="hidden" name="year_to_update" 
              value="<?php echo $friend['year']; ?>"
          />
        </form>
      </td>   
      <td>
        <form action="simpleform.php" method="post">
          <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger"  />
          <input type="hidden" name="friendname_to_delete" 
              value="<?php echo $friend['name']; ?>"
          />
        </form>  
      </td>   
  </tr>
<?php endforeach; ?>
</table>
</div>   


  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>
<!-- go grab results of footer.html and dump here
use include instead of inqure because it just won't show up if there is an error instead of terminating the whole site-->
<br>
<br>
<?php include("footer.html");?>   
</body>
</html>