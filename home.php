<!doctype html>
<html lang="en">
  <head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MovieRec</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/mystyle.css" rel="stylesheet"/>
	
  </head>
  <style>
  .image-container {
            margin-bottom: 20px;
        }

        .image-container img {
            width: 100%;
            height: 330px;
        }

        .image-details {
            text-align: center;
        }

  
  </style>
  <body>
  
  <?php include "header.php"; ?>

<?php session_start();?>

<?php include "db_connection.php"; 

?>

<div id="carouselExampleDark" class="carousel carousel-dark slide"  >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
	<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
	<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
	<!button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"><!/button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
	
	<?php
	$sql = "SELECT * FROM Movie ORDER BY averageRating DESC LIMIT 5";
        $result = $conn->query($sql);

        // Display the results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movieIDs[] = $row["movieID"];
                
            }
        } else {
            echo "No movies found.";
        }
	
	
	?>
	
      <img src="images/slide3.jpeg" class="d-block w-100" alt="...">
      
      
    </div>
    <div class="carousel-item" data-bs-interval="2000">
	<?php
		$movieID=$movieIDs[0];
		$imageFilename = $movieID . '.jpg'; 
		$imagePath = 'images/Movies/' . $imageFilename;
	?>
	<img src="<?php echo $imagePath; ?>" style="width:100%;height:750px;"class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <?php
		$movieID=$movieIDs[1];
		$imageFilename = $movieID . '.jpg'; 
		$imagePath = 'images/Movies/' . $imageFilename;
	?>
	<img src="<?php echo $imagePath; ?>" class="d-block w-100" alt="...">
      
    </div>
	<div class="carousel-item">
      <?php
		$movieID=$movieIDs[2];
		$imageFilename = $movieID . '.jpg'; 
		$imagePath = 'images/Movies/' . $imageFilename;
	?>
	<img src="<?php echo $imagePath; ?>" class="d-block w-100" alt="...">
    </div>
	<div class="carousel-item">
      <?php
		$movieID=$movieIDs[3];
		$imageFilename = $movieID . '.jpg'; 
		$imagePath = 'images/Movies/' . $imageFilename;
	?>
	<img src="<?php echo $imagePath; ?>" class="d-block w-100" alt="...">
    </div>
	<!--<div class="carousel-item">
      <!?php
		$movieID=$movieIDs[4];
		$imageFilename = $movieID . '.jpg'; 
		$imagePath = 'images/Movies/' . $imageFilename;
	?>
	<img src="<!?php echo $imagePath; ?>" class="d-block w-100" alt="...">
    </div> --->
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>






	
  <!div class="gif" style="background-image: url(images/gg.gif);height: 710px;">
  <div class="main"><p style="color:#d1d1d1;text-align:center;">Search your desired one!</p></div>

    <div class="form" style="background-color: rgba(000, 000, 000, 0.5);">
	
	
	<div class="Borders" >
		<div class="Border" style="width:50%;height:180px;">
		
		
		<div class="three">
    <form method="post" action="">
	
            <input type="hidden" name="lastClickedButton" value="<?php echo isset($_SESSION['lastClickedButton']) ? $_SESSION['lastClickedButton'] : ''; ?>" />
			

        <div class="btn-group btn-group-toggle" data-toggle="buttons">
		
            <label class="btn btn-secondary active"><button type="submit" name="submitGenre" class="btn btn-primary" style="background-color: #b80000;">Genre</button></label>
            <label class="btn btn-secondary active"><button type="submit" name="submitActor" class="btn btn-primary"style="background-color: #b80000;">Actor</button></label>
            <label class="btn btn-secondary active"><button type="submit" name="submitRating" class="btn btn-primary"style="background-color: #b80000;">Rating</button></label>
        </div>
    </form>
</div>
<form method="post" action="">
			<div class="one"><h6>
                    <?php
					$type='';
                    // Dynamically change the text based on the button clicked
                    if (isset($_POST['submitGenre'])) {
						
                        echo 'Genre';
                    } elseif (isset($_POST['submitActor'])) {
						
                        echo 'Actor';
                    } elseif (isset($_POST['submitRating'])) {
						
                        echo 'Rating';
                    } else {
                        echo 'Search Type';
                    }
                    ?>
                </h6></div>
			<div class="two"><select name="selectbox_data" class="form-control">
			
                        <?php
                        // Dynamically decide options based on the button clicked
                        if (isset($_POST['submitGenre'])) {
                            
							 $sql = "SELECT Gtype FROM genre";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['Gtype'] . '">' . $row['Gtype'] . '</option>';
                                }
                            }
                        } elseif (isset($_POST['submitActor'])) {
                            // Fetch actor names from the database and populate the options
                            $sql = "SELECT actorName FROM Actor";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['actorName'] . '">' . $row['actorName'] . '</option>';
                                }
                            }
                        } elseif (isset($_POST['submitRating'])) {
                            echo '<option value="1">Ascending</option>';
                            echo '<option value="2">Descending</option>';
                        }
                        ?>
                    </select></div>
					<div class="three" style="margin-top:10px;">
						<!input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						
					</div>
			
		</div>
		
		
		
		<div class="clear"></div>
		
	</div>
	<?php
	
	if (isset($_POST['submitGenre'])) {
    $_SESSION["type"] = 'Genre';
} elseif (isset($_POST['submitActor'])) {
    $_SESSION["type"] = 'Actor';
} elseif (isset($_POST['submitRating'])) {
    $_SESSION["type"] = 'Rating';
}
	
	
	?>
	<!Centering button>
	<div class="container">
		<div class="row">
			<div class="col text-center">
			<form method="post"> 
				<input type="submit" name="Search" class="button" value="Search" style="width: 120px ; background-color:#cf0300; border-radius: 20px; color: white" /> 
			</form>
			
			</div>
		</div>
	</div>
	
	</form>
  </div>
<div class="container-fluid" style="color:white;">
    <div class="row">
	<?php


$type = isset($_SESSION["type"]) ? $_SESSION["type"] : '';

// Rest of your code...

if ($type == 'Genre') {
    include "processGenre.php"; 
} elseif ($type == 'Actor') {
    include "processActor.php"; 
} elseif ($type == 'Rating') {
    include "processRating.php";
}

?>

	<!?php include "processRating.php"; ?>
	<!?php include "processActor.php"; ?>


	
	
  </div></div>
  
  
  
  
  <!?php
        if(array_key_exists('Search', $_POST)) { 
            Search(); 
        } 
       
        function Search() {
			echo '<input type="text" value="This is Button1 that is selected" readonly />';
		<!}

    ?> 
	<div class="Top">
		
	
	</div>

    
    <div class="flight" style="margin-top:120px;background-color:#b80000;">
		<img src="images/movie-a-day.gif" style="width: 50%;float: left;">
		<div class="txt" style="text-align: left;float: left;margin-top: 130px;margin-left: 150px;">
			<h4>Unlocking Cinematic Bliss: <br>A Journey into the World of <br>Personalized Movie Recommendations</h4>
			<p>In a world inundated with an overwhelming array of movies, finding the perfect <br>film for your mood can be akin to searching for a needle in a haystack.<br> However, the era of personalized movie recommendation engines has dawned, <br>promising to transform your cinematic experience. </p>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<?php include "footer.php"; ?>
	
	
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>