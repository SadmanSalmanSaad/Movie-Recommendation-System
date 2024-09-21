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
                    <a href="adminDashboard.php" class="nav-item nav-link active">Home</a>
                    <a href="add_movie.php" class="nav-item nav-link">Add Movie</a>
                    <a href="DeleteMovie.php" class="nav-item nav-link">Delete Movie</a>
                    <a href="UpdateMovie.php" class="nav-item nav-link">Update Movie</a>
                    <a href="CommentMonitoring.php" class="nav-item nav-link">Comment Monitoring</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a href="home.php" class="nav-item nav-link">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</div>
  </div>
 
	
	
 
    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>