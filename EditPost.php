<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php Confirm_Login(); ?>
<?php
$SearchQueryParameter = $_GET['id'];
if(isset($_POST["Submit"])){
  $PostTitle = $_POST["PostTitle"];
  $Category  = $_POST["Category"];
  $Image     = $_FILES["Image"]["name"];
  $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
  $PostText  = $_POST["PostDescription"];
  $Admin = $_SESSION["UserName"];
  date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($PostTitle)){
    $_SESSION["ErrorMessage"]= "Title Cant be empty";
    Redirect_to("Posts.php");
  }elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMessage"]= "Post Title should be greater than 5 characters";
    Redirect_to("Posts.php");
  }elseif (strlen($PostText)>9999) {
    $_SESSION["ErrorMessage"]= "Post Description should be less than than 1000 characters";
    Redirect_to("Posts.php");
  }else{
    // Query to UpdatE Post in DB When everything is fine
    global $ConnectingDB;
    if (!empty($_FILES["Image"]["name"])) {
    $sql = "UPDATE posts
            SET title='$PostTitle', category='$Category', image='$Image', post='$PostText'
            WHERE id='$SearchQueryParameter'";

          }else {
            $sql = "UPDATE posts
                    SET title='$PostTitle', category='$Category', post='$PostText'
                    WHERE id='$SearchQueryParameter'";
    }

    $Execute =$ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    //var_dunp($Execute);
    if($Execute){
    $_SESSION["SuccessMessage"]="Post Updated Successfully";
     Redirect_to("Posts.php");
    }else {
     $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Posts.php");
   }
  }
} //Ending of Submit Button If-Condition
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title> Edit Post</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#4d2600;"></div>
  <naV CLASS="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> Travel Blog</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
         <a href="MyProfile.php" class="nav-link"> <i class="far fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
         <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
         <a href="Posts.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
         <a href="Categories.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
         <a href="Admins.php" class="nav-link">Manage Admins</a>
        </li>
        <li class="nav-item">
         <a href="Comments.php" class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
         <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
        <i class=" fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
        </div>
  </nav>
  <div style="height:10px; background:#4d2600"></div>
  <!-- NAVBAR END -->
  <!-- HEADER -->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
      <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Edit Post</h1>
    </div>
    </div>
  </div>
  </header>
  <!-- HEADER END -->

  <!-- MAIN AREA -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
        <?php
         echo ErrorMessage();
         echo SuccessMessage();
         /// fetching Existing Content
         global $ConnectingDB;
       $sql  = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
       $stmt = $ConnectingDB ->query($sql);
       while ($DataRows= $stmt->fetch()) {
         $TitleToBeUpdated    = $DataRows['title'];
         $CategoryToBeUpdated = $DataRows['category'];
         $ImageToBeUpdated    = $DataRows['image'];
         $PostToBeUpdated     = $DataRows['post'];
         // code...
       }
         ?>
        <form class="" action="EditPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
                 <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Categroy: </span>
                <?php echo $CategoryToBeUpdated; ?>
                <br>
                <label for="CategoryTitle"> <span class="FieldInfo"> Choose Categroy </span></label>
                 <select class="form-control" id="CategoryTitle"  name="Category">
                   <?php
                   //Fetchinng all the categories from category table
                   global $ConnectingDB;
                   $sql = "SELECT id,title FROM category";
                   $stmt = $ConnectingDB->query($sql);
                   while ($DataRows = $stmt->fetch()) {
                     $Id = $DataRows["id"];
                     $CategoryName = $DataRows["title"];
                    ?>
                    <option> <?php echo $CategoryName; ?></option>
                    <?php } ?>
                 </select>
              </div>
              <div class="form-group mb-1">
                <span class="FieldInfo">Existing Image: </span>
                <img  class="mb-3" src="Uploads/<?php echo $ImageToBeUpdated; ?>" width="170px"; height="70px"; >
                <div class="custom-file">
                <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                <label for="imageSelect" class="custom-file-label">Select Image </label>
                </div>
              </div>
              <div class="form-group">
                <label for="Post"> <span class="FieldInfo"> Post: </span></label>
                <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                  <?php echo $PostToBeUpdated;?>
                </textarea>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i> Publish
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

  </section>
  <!-- MAIN AREA END -->
  <!-- FOOTER -->
<footer class="bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="col">
      <p class="lead text-center">Theme By | MUJTABA IJAZ | <span id="year"></span>&copy;</p>
      <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="http://Mujtabaijaz.com/coupns/" target="_blank">
        This site is only used for Study purpose Mujtabaijaz.com have all rights, no one is allowed to distribute
        copies other than <br>&trade; mujtabaijaz.com &trade;
      </a></p>
      </div>
    </div>
    </div>
</footer>
<div style="height:10px; background:#4d2600"></div>

<!-- FOOTER END -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
$('#year').text(new Date().getFullYear());
  </script>
  </body>
  </html>
