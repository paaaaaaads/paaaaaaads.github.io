<?php

session_start();

require "dbConfig.php";
require "functions.php";

include 'delete.php';

$user_data = check_login($db);

$user_data = check_login($db);

$statusMsg = '';

$targetDir = "uploads/";

if (isset($_POST["upload"])) {
    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $title = $_POST["title"];
        $category = $_POST["category"];
        $description = $_POST["description"];
        $author = $user_data['user_name'];

        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $insert = $db->query("INSERT into images (title, category, description, file_name, uploaded_on, author) VALUES ('$title', '$category', '$description','" . $fileName . "', NOW(),'$author')");

                if ($insert) {
                    $statusMsg = "The file has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
}

if ($statusMsg == "The file has been uploaded successfully.") {
    echo "<script>alert('The file has been uploaded successfully.');</script>";
} elseif ($statusMsg == "File upload failed, please try again.") {
    echo "<script>alert('File upload failed, please try again.');</script>";
} elseif ($statusMsg == "Sorry, there was an error uploading your file.") {
    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
} elseif ($statusMsg == "Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.") {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.');</script>";
} elseif ($statusMsg == "Please select a file to upload.") {
    echo "<script>alert('Please select a file to upload.');</script>";
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
    <button type="button" class="addimage btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fa-solid fa-plus"></i>
    </button>
    <div class="text-center my-3">
      <?php if (!empty($statusMsg)) { ?>
        <p class="status-msg"><?php echo $statusMsg; ?></p> 
      <?php } ?>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Painterist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="add-form">
            <form id="image-form" method="post" enctype="multipart/form-data">
              Please make sure all fields are filled in correctly. 
              <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" maxlength="12" required>
              </div>
              <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category">
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" maxlength="30" required></textarea>
              </div>
              <div class="form-group">
                <label for="formFile" class="form-label">Select an image to upload</label>
                <input class="form-control" name="file" type="file" id="formFile"> 
              </div> 
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <input class="btn btn-primary" form="image-form" type="submit" name="upload" value="Submit"> 
        </div>
      </div>
    </div>
  </div>

  <div class="gallery">
    <h1 class="welcome">Welcome</h1>
    <div class="gallery-content d-flex justify-content-center flex-wrap">
      <?php
        include "dbConfig.php";
        $author = $user_data['user_name'];
        $query = $db->query("SELECT * FROM images WHERE author = '$author' ORDER BY uploaded_on DESC");
        if ($query->num_rows > 0) {
          while ($row = $query->fetch_assoc()) {
            $imageURL = 'uploads/' . $row["file_name"];
      ?>

                <div class="card d-flex flex-wrap flex-lg-row flex-md-row flex-sm-row flex-column me-auto">
                  <div class="card-image">
                    <img src="<?php echo $imageURL; ?>" alt="<?php echo $row["file_name"]; ?>" />
                  </div>
                  <div class="card-content">
                    <h3><?php echo $row["title"]; ?> <span class="category">• <?php echo $row["category"]; ?> •</span></h3>
                    <p><?php echo $row["description"]; ?></p>
                    <p class="card-date"><small class="text-muted"><?php echo $row["uploaded_on"]; ?></small></p>
                    <form class="deleteimagefrm" action="delete.php" method="post" onSubmit="return confirm('Do you want to delete the image?')">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <input type="hidden" name="file_name" value="<?php echo $row['file_name']; ?>">
                      <button class="image-deletebtn" name="delete" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </div>
                </div>
            <?php
                }
            } else {
                 ?>
              <p>No image(s) found...</p>
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
            <a class="navbar-brand active" href="Home.php">
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
