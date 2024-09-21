
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/registration.css" rel="stylesheet"/>
	<style>
	.body{
	background-color:rgb(0, 0, 0);

}

.btn{
	color: beige;
	background-color:rgb(179, 4, 4);
	margin:10px;
}
.login{
	float: left;
	width:40%;
	margin: 30px;
	padding: 20px;
	margin-left:65px;
	color: aliceblue;
	
}
.gif img{
	float: left;
	width:50%;
	height:800px;
}
.login input{
	color:black;
    width: 100%;
    margin:10px 0;
}
.login label{
	color:white;
    width: 100%;
    margin:10px 0;
}
.login h1{
	text-align:center;
	color: aliceblue;

}
background-color:rgb(179, 4, 4);
.login h1{
	text-align:center;
	color: rgb(255, 4, 4);

}
	</style>
  </head>
  <body style="background-color:rgb(0, 0, 0);">

  <div class="full"><div class="gif">
	<img src="images/home.jpg" style="height:750px;">
  </div>
  <div class="login" style="padding-top:0px;">
	<h1>Registration</h1>
    <!-- Your registration form -->
        <form method="post" action="process_registration.php">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter your first name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter your last name" required>
			
			<label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Choose a username" required>


            <label>Email</label>
            <input type="email" name="user_email" class="form-control" placeholder="Enter your email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter your password again" required>

            <div class="container"style="padding-top:15px;">
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn" name="register"style="background-color:rgb(184, 0, 0);">Register</button>
                    </div>
                </div>
            </div>
        </form>
	
  <div class="Clear"></div>
  </div></div>
  <div class="end">
   <?php include "footer.php"; ?>
  
  </div>
 
  
 

    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>