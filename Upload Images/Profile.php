<?php

session_start();

  require("dbConfig.php");
	require("functions.php");

  $user_data = check_login($db);

  if (isset($_POST["vote"])) {
    $id = $_POST["id"];

    $query = $db->query("UPDATE images SET votes = votes + 1 WHERE id = '".$id."'");

    header('Location: Vote.php');
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painterist</title>
  <link rel="stylesheet" href="index.css">
  <link rel="websiteicon" href="images/splat.png" />
  <!--Font Awesome-->
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!--Bootstrap-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <style>

      .profile-content{
        background-color: #fff;
        padding-bottom: 200px;
      }
      
.header {
  background-image: url(https://www.volafinance.com/wp-content/uploads/2020/06/AdobeStock_305233591.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  height: 192px;
}

#profile-header {
  margin-left: 100px;
  margin-right: 100px;
}

#profile-image img {
  border: 4px solid #fff;
  border-radius: 100%;
  width: 120px;
  height: 120px;
  margin-right: 20px;
  margin-top: -30px;
}

.profile-title-header {
  padding: 8px 0;
  width: 100%;
}

.profile-about{
  padding-top: 50px;
}

.profile-about ul{
  list-style: none;
  padding: 0 !important;
} 

.profile-about ul li{
  font-size: 20px;
} 

.profile-about #profile-about-list1{
  margin-left: 45px;
}

.profile-about #profile-about-list2{
  margin-left: 10px;
}

.profile-about #profile-about-list3{
  margin-left: 15px;
}

    </style>

</head>
<body>
  

<header>
      <nav class="navbar">
        <div class="logo">
          <a class="navbar-brand" href="Home.php">
            <img src="images/splat.png" alt="" width="88" height="88" class="d-inline-block">
          </a>
        </div>

        <div class="profile mx-3 d-flex">
            <a class="navbar-brand navbar-link" href="Vote.php">Vote</a>
            <a class="navbar-brand navbar-link" href="Rankings.php">Rankings</a>
            <form class="searchbar d-flex">
              <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
              <button class="btn px-3" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <a class="navbar-brand" onclick="sidebarOpen()">
              <i class="fa-solid fa-user"></i>
            </a>
        </div>

        <nav id="sidebar">
            <ul>
                <button id="close" onclick="sidebarClose()"><i class="fa-solid fa-xmark" ></i></button>
                <li><a href="profile.php">Profile</a></li>
                <li>Privacy Policy</li>
                <li><a href="Favorites.php">Saved</a></li>
                <li>Feedback</li>
            </ul>
        </nav>
      </nav>
  </header>
    
<main>
  <div class="profile-content">

  <div class="header">
        
</div>


   <div id="profile-header" class="d-flex">

            <div id="profile-image">
                <img src="https://cdn.pixabay.com/photo/2021/03/27/06/31/code-6127616_960_720.png" alt="Forum Image">
            </div>
            
            <div class="profile-title-header">
                
                <div id="profile-title d-flex flex-column">

                  <div id="profile-title"><h3><?php echo $user_data['user_name']?></h3></div>

                </div>
            </div>
        </div>

  <section class="container profile-about">
    <h1>About</h1>
    <ul>
      <li>User ID: <span id="profile-about-list1"><?php echo $user_data['user_id']?></span></li>
      <li>User Name: <span id="profile-about-list2"><?php echo $user_data['user_name']?></span></li>
      <li>User Email: <span id="profile-about-list3"><?php echo $user_data['user_email']?></span></li>
      <li></li>
      <li></li>
      
    </ul>


    <h5 class="float-end"><a href="Logout.php">Log-out</a></h5>
  </section>


  </div>
</main>


<footer>
  <nav class="navbar justify-content-center">
        <div class="nav-links mx-5 d-flex">
            <a class="navbar-brand" href="Home.php">
              <i class="fa-solid fa-house"></i>
            </a>

            <a class="navbar-brand" href="Vote.php">
              <i class="fa-solid fa-heart"></i>
            </a>

            <a class="navbar-brand" href="Rankings.php">
              <i class="fa-solid fa-trophy"></i>
            </a>
        </div>
      </nav>
</footer>

<script>

    const sidebar = document.getElementById("sidebar")

    function sidebarClose() {
        sidebar.style.right = "-1500px"
        
    }

    function sidebarOpen() {
        sidebar.style.right = "0"
    }
    
  </script>

 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
