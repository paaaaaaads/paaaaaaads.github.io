<?php 

session_start();

  require("dbConfig.php");
	require("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_email = $_POST['user_email'];
		$password = $_POST['password'];

		if(!empty($user_email) && !empty($password) && !is_numeric($user_email))
		{

			//read from database
			$query = "select * from users where user_email = '$user_email' limit 1";
			$result = mysqli_query($db, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: Home.php");
						die;
					}
				}
			}
			
			echo '<span id="ErrorInput" 
			style="text-align: center;
			justify-content: center;
			position: absolute;
			top: 30%;
			left: 68%;
			color: red;">

			Wrong username or password!
			</span>';

		}else
		{
			echo '<span id="ErrorInput" 
			style="text-align: center;
			justify-content: center;
			position: absolute;
			top: 25%;
			left: 19%;
			color: red;">

			Wrong username or password!
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
    

    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="registrationform-logo">
          <a class="navbar-brand" href="#">
            <img src="images/splat.png" alt="" width="150" height="150" class="d-inline-block">
          </a>
        </div>
      </nav>
    </header>

    <main>
      <section>

      <div class="d-flex flex-lg-row flex-md-column flex-sm-column flex-column">

      <div class="title-div container-fluid">
        <h1 class="title">Painterist </h1>
        <p class="title-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam est cupiditate officiis incidunt deleniti autem laborum temporibus cum atque reprehenderit!</p>
      </div>

      <div class="login-links container d-flex flex-column">
        <a href="#" class="login-link my-2" ><i class="login-link-icon fa-brands fa-google"></i> Continue with Google</a>
        <a href="#" class="login-link my-2" ><i class="login-link-icon fa-brands fa-facebook"></i> Continue with Facebook</a>
        <a type="button" class="login-link my-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="login-link-icon fa-solid fa-envelope"></i> Continue another way</a>     
       
       
<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign-in</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body loginform">
          <form method="post" class="d-flex flex-column">

              <div class="form__group field">
                <input required="" id="input" placeholder="Email Address" class="form__field" name="user_email">
                <label class="form__label" for="email">Email Address</label>
              </div>

              <div class="form__group field">
                <input required="" id="input" class="form__field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" placeholder="Password" name="password">
                <label class="form__label" for="password">Password</label>
              </div>

              <input class="btn btn-primary loginbtn" id="submit" type="submit" value="Login">
              
          </form>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

  
          </div>
          <p class="my-3 mx-auto">Don't have an account? <span><a href="sign-up.php">Sign-up here</a></span></p>
      </div>

      </div>
      </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
    