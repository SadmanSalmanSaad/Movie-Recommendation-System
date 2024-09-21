<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Booking</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/header.css" rel="stylesheet"/>
	<style>
    .bg-color {
        background-color: #920000 !important;
    }
</style>

  </head>
  <body style="background:black;">
  
  <div class="header">
	<div class="m-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-color">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <div class="logo"><img src="images/ll.png"></div>
				
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
				<div class="logo-name"><h4>MovieRec</h4><p>Movie Recommendation Engine</p></div>
                    <a href="userDashboard.php" class="nav-item nav-link active">Dashboard</a>
                    <!-- <a href="add_movie.php" class="nav-item nav-link">Add Movie</a> -->
                    <a href="RateMovie.php" class="nav-item nav-link">Rate Movie</a>
                    <!-- <a href="aboutus.php" class="nav-item nav-link">About Us</a>
                    <a href="contactus.php" class="nav-item nav-link">Contact Us</a> -->
					<a href="logout.php" class="nav-item nav-link">Logout</a>
                </div>
				
				<?php
					session_start();
					// Retrieve the username from the session
					$username = $_SESSION["username"];
				?>
                <div class="navbar-nav ms-auto">
					<i class='far fa-user-circle' style='font-size:50px;background-color:#920000;'></i>
					<?php
						if (!isset($_GET['showSidebar'])) {
							echo '<a href="?showSidebar=true"> Welcome ' . htmlspecialchars($username) . '</a>';
						}
					?>
                    <!a href="" class="nav-item nav-link"><!?php echo htmlspecialchars($username); ?><!/a>
                </div>
            </div>
        </div>
    </nav>
</div>
  </div>
 
	
	

	<script src="https://kit.fontawesome.com/3f0364f287.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>