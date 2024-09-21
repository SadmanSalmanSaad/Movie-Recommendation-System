<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Booking</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	    <style>
        body {
            padding: 20px;
        }

        .image-container {
            margin-bottom: 20px;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .image-details {
            text-align: center;
        }

        
        .sidebar {
            background-color: #920000;
			color:white;
            padding: 20px;
            position: fixed;
            top: 0;
            <?php echo isset($_GET['showSidebar']) ? 'right: 0;' : 'right: -250px;'; ?> 
            height: 100%;
            width: 250px;
            overflow-y: auto;
            border-left: 1px solid #dee2e6;
            transition: right 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                border-left: none;
                margin-top: 20px;
            }
        }
		.close-sidebar {
			
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
        }
		.card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
  </head>
  <body style="background-color:black;">
  
  <?php include "afterLoginHeader.php"; ?>
  
  <div class="container-fluid" style="color:white;">
    <div class="row">
		<div ><h3>Top Ranked Movie</h3></div>
        <!-- Image Gallery -->
       <?php
include "db_connection.php";

$sql = "SELECT * FROM Movie ORDER BY averageRating DESC LIMIT 5";
$result = $conn->query($sql);

// Display the results
if ($result->num_rows > 0) {
    echo '<div class="col-lg-12"><div class="row">';

    while ($row = $result->fetch_assoc()) {
        $movieID = $row["movieID"];
        $imageSrc = "images/Movies/$movieID.jpg";

        echo '<div class="col-lg-2 col-md-6 mb-4">';
        echo '<div class="card">';
        echo '<img src="' . $imageSrc . '" class="card-img-top" alt="Movie Image">';
        echo '<div class="card-body" style="color:white;background-color: black;">';
        echo '<h6 class="card-title">' . $row["movieName"] . '</h6>';
        echo '<p class="card-text small">' . $row["Descriptions"] . '</p>';
		echo '<p class="card-text small">' . "Average Rating: " . $row["averageRating"] . '</p>';
                echo '<p class="card-text small">' . "Release Date: " . $row["releaseDate"] . '</p>';
                echo '<p class="card-text small">' . "Director: " . $row["director"] . '</p>';
        echo '</div></div></div>';
    }

    echo '</div></div>';
} else {
    echo '<div class="col-12 text-center">No movies found.</div>';
}
?>



        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="sidebar">
                <span class="close-sidebar"><a href="userDashboard.php" ><i class="fas fa-times"></i></a></span>
                <div style="margin-top:60px;"><h4>User Information</h4>
				<i class='far fa-user-circle' style='font-size:50px;background-color:#920000;margin-left:70px;'></i>
				<div style="padding:30px 0;"><?php
				// Retrieve the username from the session
					$username = $_SESSION["username"];
				// Fetch user information
                          $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>First Name: " . $row["firstName"] . "</p>";
                    echo "<p>Last Name: " . $row["lastName"] . "</p>";
                    echo "<p>User Name: " . $row["username"] . "</p>";
                    echo "<p>Email: " . $row["Email"] . "</p>";
                    // Add more user information as needed
                }
            } else {
                echo "User not found";
            }
        ?></div></div>

				
				
                
                <!-- Add more user information as needed -->
            </div>
        </div>
		
		

    </div>
</div>
<div style="color:white;">
<div ><h3>Watch List</h3></div>
<div class="col-lg-9">
    <div class="row" >
        <?php
        $query = "SELECT m.movieID, m.movieName, m.Descriptions, m.averageRating, m.releaseDate, m.director
                  FROM Movie AS m
                  JOIN rate AS r ON m.movieID = r.movieID
                  AND r.userID IN (SELECT userID FROM users WHERE username = ?)";

        //movie details from movie table
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $_SESSION["username"]);
        $stmt->execute();

        $result = $stmt->get_result();

        // Display the results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movieID = $row["movieID"];
                $imageSrc = "images/Movies/$movieID.jpg";

                echo '<div class="col-lg-3 col-md-6 mb-4">';
                echo '<div class="card">';
                echo '<img src="' . $imageSrc . '" class="card-img-top" alt="Movie Image">';
                echo '<div class="card-body" style="color:white;background-color: black;">';
                echo '<h6 class="card-title">' . $row["movieName"] . '</h6>';
                echo '<p class="card-text small">' . $row["Descriptions"] . '</p>';
                echo '<p class="card-text small">' . "Average Rating: " . $row["averageRating"] . '</p>';
                echo '<p class="card-text small">' . "Release Date: " . $row["releaseDate"] . '</p>';
                echo '<p class="card-text small">' . "Director: " . $row["director"] . '</p>';

                 // Create a form for each "Recommendation" button
                echo '<form method="post" action="Recommendation.php">';
                echo '<input type="hidden" name="movieID" value="' . $movieID . '">';
                echo '<button type="submit" class="btn btn-danger btn-sm mt-2" style="background-color: #B80000; width: 100%;">Recommendation</button>';
                echo '</form>';

                echo '</div></div></div>';
            }
        } else {
            echo '<div class="col-12 text-center">No movies found.</div>';
        }

        $stmt->close();
        ?>
    </div>
</div>
</div>
	<?php include "footer.php"; ?>
	
	
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>