<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <style>


	body{
		color:white;
		padding: 25px;
		background-color: black;
	}

	h1 {
		padding-bottom: 15px;
	}

	.alert {
		margin-top: 25px;
	}
	.height-100{
    height:100vh;
}





	</style>
	  
    <title>Rating Movie</title>
  </head>
  <body >
<?php include "afterLoginHeader.php"; ?>
    <div class="col text-center">
    <h1 style="color:white;">Rate Your Favourite Movie</h1></div>
   <form  style="margin:70px;" action="processRateMovie.php" method="post" enctype="multipart/form-data"><div class="row g-3" style="background-color:#B80000;padding:20px;">
   <div class="col-md-6"style="color:white;">
    <label for="inputZip" class="form-label">Movie Name</label>
    <input type="text" class="form-control" id="movieName" name="movieName"  placeholder="Enter Movie Name" required>
  </div>
  <div class="col-md-6"style="color:white;">
    <label for="inputEmail4" class="form-label">Last View</label>
    <input type="datetime-local" id="ReleaseDate" name="ReleaseDate" class="form-control" placeholder="Enter Release Date" required>
  </div>
  
  
  <div class="col-md-6" style="color:white;">
    <label for="comment" class="form-label">Comment</label>
    <textarea class="form-control" id="comment" name="Description" placeholder="Enter your comment" required></textarea>
</div>

  
<div class="col-md-6" style="color:white;">
    <label for="comment" class="form-label">Rate Movie :</label>
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="ratings" style="color:black;">
                <input type="radio" name="rate" id="rate-5" value="1" >
                <label for="rate-5" class="fas fa-star rating-color"></label> 

                <input type="radio" name="rate" id="rate-4" value="2">
                <label for="rate-4" class="fas fa-star rating-color"></label>

                <input type="radio" name="rate" id="rate-3" value="3">
                <label for="rate-3" class="fas fa-star rating-color"></label>

                <input type="radio" name="rate" id="rate-2" value="4">
                <label for="rate-2" class="fas fa-star rating-color"></label>

                <input type="radio" name="rate" id="rate-1" value="5">
                <label for="rate-1" class="fas fa-star rating-color"></label>
            </div>
        </div>
    </div>
</div>



</div>

  

  
  <div class="container" style="margin-top:20px;">
		<div class="row">
			<div class="col text-center">
			<form method="post"> 
				<input type="submit" name="Search" class="button" value="ADD" style="width: 120px ; background-color:#cf0300; border-radius: 20px; color: white" /> 
			</form>
			
			</div>
		</div>
	</div>
</form>





<?php include "footer.php"; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
  </body>
</html>

