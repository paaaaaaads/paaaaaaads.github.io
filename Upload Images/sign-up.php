<?php 

session_start();

    require("dbConfig.php");
	  require("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if(!empty($user_name) && !empty($user_email) && !empty($password) && !empty($confirm_password) && !is_numeric($user_name))
		{

			if ($_POST["password"] === $_POST["confirm_password"]) {

				//save to database
				$user_id = random_num(20);
				$query = "insert into users (user_id,user_name,user_email,password, confirm_password) values ('$user_id','$user_name','$user_email','$password','$confirm_password')";

				mysqli_query($db, $query);

				header("Location: index.php");
				die;

			 }
			 else {

			    echo '<span id="ErrorInput" 
			    style="text-align: center;
			    justify-content: center;
			    position: absolute;
			    top: 15%;
			    right: 28%;
			    color: red;">

			    Password not match!
			    </span>';
			 }
			
		}else
		{
			echo '<span id="ErrorInput" 
			style="text-align: center;
			justify-content: center;
			position: absolute;
			top: 15%;
			right: 28%;
			color: red;">

			Password not match!
			</span>';   
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painterist</title>
    <link rel="stylesheet" href="index.css" />
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
    <header class="header-signup">
      <div class="custom-shape-divider-top-1675911947">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
</div>
        <nav class="navbar navbar-expand-lg">
          <div class="registrationform-logo">
            <a class="navbar-brand" href="#">
              <img src="images/splat.png" alt="" width="88" height="88" class="d-inline-block">
            </a>
          </div>
        </nav>
      </header>
  
    
    <main>
      <section>

      <div class="d-flex flex-lg-row flex-md-column flex-sm-column flex-column">

      <div class="register-div d-flex flex-column flex-sm-column flex-md-column flex-column align-items-center">
        <h1 class="title text-center">Registration <br> Form</h1>
        <p class="title-description text-center">Already have an account? <span><a href="index.php">Sign-in here</a></span></p>
      </div>


      <div class="signupform">
        <form class="my-4" method="post">
            <div class="form__group field">
                <input class="form__field" class="input" type="text" placeholder="Username" name="user_name" required> 
                <label class="form__label" for="user_name">Username</label> <br>
              </div>

            <div class="form__group field">
                <input class="form__field" class="input" type="email" placeholder="Email" name="user_email" required>
                <label class="form__label" for="user_email">Email</label> <br>
            </div>

            <div class="form__group field">
              <input class="form__field" class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"  type="password" placeholder="Password" name="password" required>
              <label class="form__label" for="password">Password</label> <br>
            </div>

            <div class="form__group field">
              <input class="form__field" class="input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" placeholder="Confirm Password" name="confirm_password" required>
              <label class="form__label" for="confirm_password">Confirm Password</label> <br>  
            </div>

            <div class="signupform-group">
                <input class="signupbtn btn btn-primary" type="submit" value="Submit">    
            </div>
        </form>
    </div>

    

      </div>
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
    
