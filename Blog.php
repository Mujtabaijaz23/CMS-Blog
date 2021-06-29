<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Blog Page</title>
  <style media="screen">
  .heading{
      font-family: Bitter,Georgia,"Times New Roman",Times,serif;
      font-weight: bold;
       color: #005E90;
  }
  .heading:hover{
    color: #0090DB;
  }
  </style>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:40px; background:#ffffff;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> Travel Blog</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:70px; background:#4d2600;">
      <div class="col-sm-8">
        <h1 class="text-white"> Exploring The World Through My Life </h1>
      </div>
    </div>
    <!-- NAVBAR END -->


  <!-- HEADER -->
  <div class="container">
      <div class="row mt-4">
            <!-- MAIN AREA START-->
            <div class="col-sm-8">
              <h1>The Complete Guide for Travelling Blog</h1>
              <h1 class="lead">Presented to you by Mujtaba Ijaz</h1>
              <?php
               echo ErrorMessage();
               echo SuccessMessage();
               ?>
              <?php
              global $ConnectingDB;
          // SQL query when Searh button is active
          if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          }// Query When Pagination is Active i.e Blog.php?page=1
          elseif (isset($_GET["page"])) {
            $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
          }else{
            $ShowPostFrom=($Page*5)-5;
          }
            $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
            $stmt=$ConnectingDB->query($sql);
          }
          // Query When Category is active in URL Tab
          elseif (isset($_GET["category"])) {
            $Category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
            $stmt=$ConnectingDB->query($sql);
          }
          // The default SQL query
      else{
        $sql  = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
        $stmt =$ConnectingDB->query($sql);
      }
      while ($DataRows = $stmt->fetch()) {
        $PostId          = $DataRows["id"];
        $DateTime        = $DataRows["datetime"];
        $PostTitle       = $DataRows["title"];
        $Category        = $DataRows["category"];
        $Admin           = $DataRows["author"];
        $Image           = $DataRows["image"];
        $PostDescription = $DataRows["post"];
      ?>
      <div class="card">
        <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
        <div class="card-body">
          <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
          <small class="text-muted">Category: <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>
          <span style="float:right;" class="badge badge-dark text-light">Comments:
             <?php echo ApproveCommentsAccordingtoPost($PostId);?>
          </span>
          <hr>
          <p class="card-text">
            <?php if (strlen($PostDescription)>150) { $PostDescription = substr($PostDescription,0,150)."...";} echo htmlentities($PostDescription); ?></p>
          <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float:right;">
            <span class="btn btn-info">Read More &rang;&rang; </span>
          </a>
        </div>
      </div>
      <br>
      <?php   } ?>
      <!-- Pagination -->
          <nav>
            <ul class="pagination pagination-md">
              <!-- Creating Backward Button -->
              <?php if( isset($Page) ) {
                if ( $Page>1 ) {?>
             <li class="page-item">
                 <a href="Blog.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            global $ConnectingDB;
            $sql           = "SELECT COUNT(*) FROM posts";
            $stmt          = $ConnectingDB->query($sql);
            $RowPagination = $stmt->fetch();
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/5;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if( isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if ( isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Blog.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
        </div>
        <!-- Main Area End-->

        <!-- Side Area Start -->
<div class="col-sm-4">
  <div class="card mt-4">
    <div class="card-body">
      <img src="images/Jordan.jpg" class="d-block img-fluid mb-3" alt="">
      <div class="text-center">
        Jordan was my first-ever trip to the Middle East, and I honestly had NO idea what to expect. After spending two weeks exploring the beautiful country, it is easy to see why it’s one of my all-time favorite destinations.
        I began my journey through Jordan in the capital city of Amman. I had an absolute BLAST exploring the city like a local and discovering everything from delicious food to ancient Roman ruins.
        I was astounded by the Dead Sea, impressed by the underwater splendor of Aqaba, inspired by the ruins of Petra, and mesmerized by the magic of the desert stars in Wadi Rum
        March to May (spring) is the best time to travel to Jordan if you’re an avid hiker. The country’s desert landscape transforms into a blanket of wildflowers, and the forests are lush and green.
        September to November (autumn) is another good period to plan a trip to Jordan. The hot summer temperatures start to cool down and diving conditions at the Gulf of Aqaba are at their best.
        GETTING TO PETRA:
        The best way to get to Petra is to hire a car or book a driver. Located 250km from Amman, you can follow a scenic 2.5-hour route to the ruins.
        If you want to cut down your travel time, you can fly from Queen Alia International Airport to Aqaba.
        I recommend arranging a transfer directly with your hotel or booking a car in advance. Once you arrive, you won't have to worry about haggling and can avoid getting ripped off.
        WHAT TO WEAR:
        The most important thing to pack for Petra is a good pair of walking shoes. You're going to spend hours wandering around the ruins and rocky ground.
        There is hardly any shade around the site. Keep the sun off your face by bringing a hat and putting on plenty of sunscreen. I also recommend wearing loose, breathable fabrics that cover as much skin as possible.
        If you're staying in Petra after sunset, pack an extra layer of warm clothes for when the temperatures drop.
      </div>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header bg-dark text-light">
      <h2 class="lead">Sign Up !</h2>
    </div>
    <div class="card-body">
      <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
      <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
        <div class="input-group-append">
          <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header bg-primary text-light">
      <h2 class="lead">Categories</h2>
      </div>
      <div class="card-body">
        <?php
        global $ConnectingDB;
        $sql = "SELECT * FROM category ORDER BY id desc";
        $stmt = $ConnectingDB->query($sql);
        while ($DataRows = $stmt->fetch()) {
          $CategoryId = $DataRows["id"];
          $CategoryName=$DataRows["title"];
         ?>
        <a href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
       <?php } ?>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header bg-info text-white">
      <h2 class="lead"> Recent Posts</h2>
    </div>
    <div class="card-body">
      <?php
      global $ConnectingDB;
      $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
      $stmt= $ConnectingDB->query($sql);
      while ($DataRows=$stmt->fetch()) {
        $Id     = $DataRows['id'];
        $Title  = $DataRows['title'];
        $DateTime = $DataRows['datetime'];
        $Image = $DataRows['image'];
      ?>
      <div class="media">
        <img src="Uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
        <div class="media-body ml-2">
        <a style="text-decoration:none;"href="FullPost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
          <p class="small"><?php echo htmlentities($DateTime); ?></p>
        </div>
      </div>
      <hr>
      <?php } ?>
    </div>
  </div>

</div>
<!-- Side Area End -->


</div>

</div>

<!-- HEADER END -->
<br>
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
<div style="height:30px; background:#4d2600"></div>

<!-- FOOTER END -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
$('#year').text(new Date().getFullYear());
  </script>
  </body>
  </html>
