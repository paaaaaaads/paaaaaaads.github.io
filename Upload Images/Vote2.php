<?php

session_start();

    require("dbConfig.php");
    require("functions.php");

  $user_data = check_login($db);

  if (isset($_POST["vote"])) {
    $id = $_POST["id"];

    $query = $db->query("UPDATE images SET votes = votes + 1 WHERE id = '".$id."'");

    header('Location: Rankings.php');

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
            <form class="searchbar d-flex" action="search.php" method="post" >
              <input class="form-control me-2 " type="search" name="title-search" placeholder="Search" aria-label="Search">
              <button class="btn px-3" name="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
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
  <div class="container-fluid">
    <h1 class="welcome welcome-vote">
      <a href="#votesection">Vote</a>
      <span>
        <small>
          <a class="float-end" href="Vote.php">Carousel View</a>
        </small>
      </span>
    </h1>

    <div class="gallery my-5" id="votesection">
      <div class="gallery-content d-flex justify-content-center flex-wrap">
        <?php
          include "dbConfig.php";
          $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
          
          if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
              $imageURL = 'uploads/'.$row["file_name"];
        ?>
              <div class="card d-flex flex-wrap flex-lg-row flex-md-row flex-sm-row flex-column me-auto">
                <div class="card-image">
                  <img src="<?php echo $imageURL; ?>" class="card-image" alt="<?php echo $row["file_name"] ?>" />
                </div>
                <div class="card-content">
                  <h3><?php echo $row["title"] ?> <span class="category">• <?php echo $row["category"] ?> •</span></h3>
                  <p><?php echo $row["description"] ?></p>
                  <p class="">
                    <small class="text-muted"><?php echo $row["uploaded_on"] ?></small>
                    <span class="category-vote float-end"><b class="text-muted">• Vote(s) <?php echo $row["votes"] ?> •</b></span>
                  </p>
                  <form class="voteimagefrm float-end" method="post" onSubmit="return confirm('Do you want to VOTE the image? You can only vote ONCE')">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                    <input type="hidden" name="file_name" value="<?php echo $row['file_name']; ?>" />
                    <button name="vote" type="submit" onclick="votebtn()" id="votebtn" class="votebtn">♥ Vote</button>
                  </form>
                  <form class="unsaveimagefrm" action="save.php" method="post" onSubmit="return confirm('Do you want to save the image?') ">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="file_name" value="<?php echo $row['file_name']; ?>">
                    <button class="image-savebtn" name="save" type="submit"><i class="fa-regular fa-bookmark"></i></button>
                  </form>
                </div>
              </div>
        <?php
            }
          } else {
        ?>
            <p>No favorite image(s) found...</p>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</main>

<footer>
  <nav class="navbar justify-content-center">
        <div class="nav-links mx-5 d-flex">
            <a class="navbar-brand" href="Home.php">
              <i class="fa-solid fa-house"></i>
            </a>

            <a class="navbar-brand  active" href="Vote.php">
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

    function votebtn() {
        const vote = document.getElementById("votebtn");
        const voteClick = (vote.innerHTML = "♥ Voted");
        const voteUnclick = (vote.innerHTML = "♥ Vote");

        if (vote.innerHTML == voteUnclick) {
          vote.innerHTML = voteClick;
          vote.style.backgroundColor = "rgb(248, 35, 35)";
          vote.disabled = true;
        } else {
        }
      }
    
  </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>