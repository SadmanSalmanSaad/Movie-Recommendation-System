<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MovieRec Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/loginstyle.css" rel="stylesheet"/>
	<style>
	.login{
	float: left;
	width:30%;
	margin: 30px;
	padding: 20px;
	margin-left:65px;
	color: aliceblue;
	
}
.gif img{
	float: left;
	width:60%;
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

	</style>
  </head>
  <body style="background-color: black">
  <?php include "header.php"; ?>
  <div class="full"><div class="gif">
	<!img src="images/home.jpg" style="height:800px;">
	<img src="images/login.gif" >
	
  </div>
  <div class="login">
	<h1>Login</h1>
	<form method="post" action="process_login.php">
    <label for="username" >Username:</label>
    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Your Username" required>
	<label for="password">Password:</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
	
	 
	
	<div class="container"style="padding-top:15px;">
		<div class="row">
			<div class="col text-center">
			<button type="submit" class="btn" style="background-color:rgb(184, 0, 0);">Login</button>
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