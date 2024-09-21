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
			color:white;
        }

        .image-container {
            margin-bottom: 20px;
			float:right;
			margin-right:20px;
        }

        .image-container img {
			
            width: 100%;
            height: auto;
        }

        .image-details {
            text-align: center;
        }
		.card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }
		
		
		body {
            background-color: #121212;
            color: #ffffff;
            padding-top: 60px;
        }

        .container {
            margin-top: 20px;
        }

        
        h3,
        h5 {
            color: #ff5252;
        }

        p {
            color: #bdbdbd;
        }

        .comment {
            font-style: italic;
            color: #64ffda;
        }

        .last-view {
            color: #69f0ae;
        }
		.card-text{
			color:white;
			
		}
		.card-title{
			text-align: center;
		}
       
    </style>
  </head>
  <body style="background-color:black;color:white;">
<?php
include "afterLoginHeader.php";
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve movieID from the submitted form
    $movieID = $_POST["movieID"];

    // Fetch movie details based on the movieID
    $sql = "SELECT * FROM Movie AS m JOIN rate AS r ON m.movieID = r.movieID WHERE m.movieID = $movieID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movieID = $row["movieID"];
        $imageSrc = "images/Movies/$movieID.jpg";
?>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-sm-3 text-white d-flex align-items-center" style="background-color: rgb(184, 0, 0);">
                    <!-- Content for the first column -->
                </div>

                <div class="col-sm-3 bg-dark text-white d-flex align-items-center">
                     <div class="movie-details">
                    <h3>Movie Name: <?php echo $row["movieName"]; ?></h3>
                    <p>Description: <?php echo $row["Descriptions"]; ?></p>
                    <p>Release Date: <?php echo $row["releaseDate"]; ?></p>
                    <p>Director: <?php echo $row["director"]; ?></p>
                    <p class="comment">Comment: <?php echo $row["comment"]; ?></p>
                    <h5 class="last-view">Last View: <?php echo $row["lastView"]; ?></h5>
                    <p>Explore the evolution of cinema, from the silent film era to the present day, highlighting key milestones and influential figures.</p>
                </div>
                </div>

                <div class="col-sm-3 bg-dark text-white d-flex align-items-center">
                    <!-- Content for the third column -->
                </div>

                <div class="col-sm-3 bg-dark text-white d-flex align-items-center">
                    <div class="ml-auto mr-4"> <!-- Utilizing ml-auto to push the image to the right -->
                        <?php
                        echo '<div class="image-container">';
                        echo '<img src="' . $imageSrc . '" alt="Movie Image" class="img-fluid rounded shadow">';
                        echo '<div class="image-details">';
                        echo '</div></div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>

<div><?php $movieID = $_POST["movieID"]; ?>
<div class="recommendation-section">
    <h3 class="mt-5">Genre Based Recommendation</h3>
    <div class="row recommendation-container">
        <?php
        $genreQuery = "SELECT 
                            m.movieID,
                            m.movieName,
                            m.Descriptions,
                            m.averageRating,
                            m.releaseDate,
                            m.director,
                            g.Gtype
                        FROM 
                            Movie AS m
                        JOIN 
                            Belongs_to AS b ON m.movieID = b.movieID
                        JOIN 
                            Genre AS g ON b.genreID = g.genreID
                        WHERE 
                            b.genreID IN (SELECT genreID FROM Belongs_to WHERE movieID = ?)";

        $stmt = $conn->prepare($genreQuery);
        $stmt->bind_param("i", $movieID);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-2 col-lg-2 recommendation-item">';
                echo '<div class="card mb-2">';
                echo '<img src="images/Movies/' . $row["movieID"] . '.jpg" class="card-img-top" alt="Movie Image">';
                echo '<div class="card-body" style="color:white;background-color: black;">';
                echo '<h6 class="card-title">' . $row["movieName"] . '</h6>';
                echo '<p class="card-text small">' . "Descriptions: " . $row["Descriptions"] . '</p>';
                echo '<p class="card-text small">' . "Average Rating: " . $row["averageRating"] . '</p>';
                echo '<p class="card-text small">' . "Release Date: " . $row["releaseDate"] . '</p>';
                echo '<p class="card-text small">' . "Director: " . $row["director"] . '</p>';
                echo '<p class="card-text font-weight-bold small">' . "Genre: " . $row["Gtype"] . '</p>';
                echo '</div></div></div>';
            }
        } else {
            echo '<div class="col-12 ">No genre recommendations found.</div>';
        }

        $stmt->close();
        ?>
    </div>
</div>

<div>
    <?php
    $movieID = $_POST["movieID"];
    ?>
    <h3 class="mt-5">Actor Based Recommendation</h3>
    <?php
    $query = "SELECT 
        m.movieID,
        m.movieName,
        m.Descriptions,
        m.averageRating,
        m.releaseDate,
        m.director,
        a.actorName
    FROM 
        Movie AS m
    JOIN 
        acts AS b ON m.movieID = b.movieID
    JOIN 
        Actor AS a ON b.actorID = a.actorID
    WHERE 
        b.actorID IN (SELECT actorID FROM acts WHERE movieID = ?);";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movieID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="row">';

        while ($row = $result->fetch_assoc()) {
            $movieID = $row["movieID"];
            $imageSrc = "images/Movies/$movieID.jpg";

            echo '<div class="mt-5 col-lg-2 col-md-6 col-sm-12">';
            echo '<div class="card">';
            echo '<img src="' . $imageSrc . '" alt="Movie Image" class="card-img-top img-fluid">';
            echo '<div class="card-body" style="color:white;background-color: black;">';
            echo '<h5 class="card-title">' . $row["movieName"] . '</h5>';
            echo '<p class="card-text small">' . "Descriptions: " . $row["Descriptions"] . '</p>';
            echo '<p class="card-text small">' . "Average Rating: " . $row["averageRating"] . "<br>" . '</p>';
            echo '<p class="card-text small">' . "Release Date: " . $row["releaseDate"] . "<br>" . '</p>';
            echo '<p class="card-text small" style="font-weight:bold;">' . "Actor: " . $row["actorName"] . "<br><br>" . '</p>';
            echo '</div></div></div>';
        }

        echo '</div>';
    } else {
        echo '<div class="col-12 ">No movies found.</div>';
    }

    $stmt->close();
    ?>
<!-- </div>

<div> //it's already commented out. even if the below code is colorful.
    <?php
    $movieID = $_POST["movieID"];
    ?>
    <h3 class="mt-5">Director Based Recommendation</h3>
    <?php
    $query = "SELECT movieID, movieName, Descriptions, averageRating, releaseDate, director
            FROM Movie 
            WHERE director IN (SELECT director FROM movie WHERE movieID = ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movieID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="row">';

        while ($row = $result->fetch_assoc()) {
            $movieID = $row["movieID"];
            $imageSrc = "images/Movies/$movieID.jpg";

            echo '<div class="mt-5 col-lg-2 col-md-6 col-sm-12">';
            echo '<div class="card">';
            echo '<img src="' . $imageSrc . '" alt="Movie Image" class="card-img-top img-fluid">';
            echo '<div class="card-body" style="color:white;background-color: black;">';
            echo '<h5 class="card-title">' . $row["movieName"] . '</h5>';
            echo '<p class="card-text">' . "Descriptions: " . $row["Descriptions"] . '</p>';
            echo '<p class="card-text">' . "Average Rating: " . $row["averageRating"] . "<br>" . '</p>';
            echo '<p class="card-text">' . "Release Date: " . $row["releaseDate"] . "<br>" . '</p>';
            echo '<p class="card-text" style="font-weight:bold;">' . "Director: " . $row["director"] . "<br><br>" . '</p>';
            echo '</div></div></div>';
        }

        echo '</div>';
    } else {
        echo '<div class="col-md-12 ">No movies found.</div>';
    }

    $stmt->close();
    ?>
</div> -->

  
	<?php include "footer.php"; ?>
	
	
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="js/bootstrap.bundle.min.js"></script>
	</body>
</html>