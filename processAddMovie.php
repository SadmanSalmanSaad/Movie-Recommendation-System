<?php
include "db_connection.php"; // Include your database configuration file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $movieName = $_POST["movieName"];
    $releaseDate = $_POST["ReleaseDate"];
    $director = $_POST["director"];
    $actor = $_POST["actor"];
    $genre = $_POST["genre"];
    $Description = $_POST["Description"];
	$genreID=0;
	$actorID=0;
	
	
	
			try {
    // Start the transaction
    $conn->begin_transaction();	
	
	//image 6 upload hoy rename kora baki image plan:
	/*How to rename uploaded image file in php, I want to rename every image file i upload. 
	I am working for a e-commerce site, i want to upload each image with their movieID from database.
	movie id should be like (1.jpg) at the end and upload its name to the database. where 1 is movieID .*/
	//*=================================================================================================================================*/
	
	
	
	
		// File upload handling
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

	
	
	
	//*=================================================================================================================================*/
	
	
	
	
	

    // Check if the movie already exists in the database
    $checkQuery = "SELECT * FROM Movie WHERE movieName = ?";
    $checkStatement = $conn->prepare($checkQuery);
    $checkStatement->bind_param("s", $movieName);
    $checkStatement->execute();
    $result = $checkStatement->get_result();

    if ($result->num_rows > 0) {
        // Movie already exists, show an error message or take appropriate action
        echo "<div class='alert alert-danger' role='alert'>Movie with the same name already exists in the database.</div>";
    } else {
        // Movie does not exist, insert the data into the database
        $insertQuery = "INSERT INTO Movie (movieName, releaseDate, director,Descriptions) VALUES (?, ?, ?, ?)";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bind_param("ssss", $movieName, $releaseDate, $director, $Description);

        if ($insertStatement->execute()) {
            // Movie data inserted successfully, now insert actor and genre data


			// Check if the genre already exists in the database
			$checkQuery = "SELECT * FROM genre WHERE Gtype = ?";
			$checkStatement = $conn->prepare($checkQuery);
			$checkStatement->bind_param("s", $genre);
			$checkStatement->execute();
			$result = $checkStatement->get_result();
			
			// genre already exists
			if ($result->num_rows > 0) {
				// Assuming Gtype is unique, so there should be only one row
				$row = $result->fetch_assoc();
				$genreID = $row['genreID'];
    
				$checkQuery = "SELECT * FROM Movie WHERE movieName = ?";
				$checkStatement = $conn->prepare($checkQuery);
				$checkStatement->bind_param("s", $movieName);
				$checkStatement->execute();
				$result = $checkStatement->get_result();
				
				$row = $result->fetch_assoc();
				$movieID = $row['movieID'];
				
				$insertQuery = "INSERT INTO belongs_to (genreID, movieID) VALUES (?, ?)";
				$insertStatement = $conn->prepare($insertQuery);
				$insertStatement->bind_param("ii", $genreID, $movieID); // Assuming both genreID and movieID are integers
				$insertStatement->execute();

				if ($insertStatement->affected_rows > 0) {
					echo "Values successfully inserted into belongs_to table.";
				} else {
					echo "Error inserting values: " . $insertStatement->error;
				}

				$insertStatement->close();
				
			} else {
				//echo "Genre not found in the database.";
				$insertgenreQuery = "INSERT INTO genre (Gtype) VALUES (?)";
				$insertgenreStatement = $conn->prepare($insertgenreQuery);
				$insertgenreStatement->bind_param("s", $genre); 
				$insertgenreStatement->execute();

				if ($insertgenreStatement->affected_rows > 0) {
					echo "Values successfully inserted into genre table.";
					// Retrieve the last inserted ID
					$genreID = mysqli_insert_id($conn);
					
					$checkQuery = "SELECT * FROM Movie WHERE movieName = ?";
					$checkStatement = $conn->prepare($checkQuery);
					$checkStatement->bind_param("s", $movieName);
					$checkStatement->execute();
					$result = $checkStatement->get_result();
				
					$row = $result->fetch_assoc();
					$movieID = $row['movieID'];
				
					$insertQuery = "INSERT INTO belongs_to (genreID, movieID) VALUES (?, ?)";
					$insertStatement = $conn->prepare($insertQuery);
					$insertStatement->bind_param("ii", $genreID, $movieID); // Assuming both genreID and movieID are integers
					$insertStatement->execute();

					if ($insertStatement->affected_rows > 0) {
						echo "Values successfully inserted into belongs_to table.";
					} else {
						echo "Error inserting values: " . $insertStatement->error;
					}

					$insertStatement->close();
				} else {
					echo "Error inserting values: " . $insertgenreStatement->error;
				}
				
			}
			

            

            // You need to fetch actorID based on the actorName from the Actor table
            // Replace the following line with the actual code to fetch actorID
			
			// Escape the variable to prevent SQL injection
			$escapedActor = mysqli_real_escape_string($conn, $actor);

			// SQL query to retrieve actorID based on actorName
			$sql = "SELECT actorID FROM Actor WHERE actorName = '$actor'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// ActorName found in the database, fetch and print actorID
				$row = $result->fetch_assoc();
				$actorID = $row['actorID'];
				echo "ActorName: $actor matches. ActorID: $actorID";
				
				$insertActorStatement->bind_param("ii", $movieID, $actorID);
				$insertActorStatement->execute();

				$insertActorStatement->close();
				
				
				// You need to fetch genreID based on the genre from the genre table
				// Replace the following line with the actual code to fetch genreID
				// Replace with the actual genreID

				// Show success message or redirect to a success page
				echo "<div class='alert alert-success' role='alert'>Movie details added successfully.</div>";
			} else {
				// ActorName not found in the database
				echo "ActorName: $actor does not exist in the database.";
				$insertActorQuery = "INSERT INTO Actor (actorName) VALUES (?)";
				$insertActorStatement = $conn->prepare($insertActorQuery);
				$insertActorStatement->bind_param("s", $escapedActor); 
				$insertActorStatement->execute();

				if ($insertActorStatement->affected_rows > 0) {
					echo "Values successfully inserted into actor table.";
				} else {
					echo "Error inserting values: " . $insertActorStatement->error;
				}

				$insertActorStatement->close();
				// SQL query to retrieve actorID based on actorName
				$sql = "SELECT actorID FROM Actor WHERE actorName = '$actor'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// ActorName found in the database, fetch and print actorID
					$row = $result->fetch_assoc();
					$actorID = $row['actorID'];
				}

				
			}
			
				// Insert actorID data
				$insertActorIDQuery = "INSERT INTO Acts (movieID, actorID) VALUES (?, ?)";
				$insertActorIDStatement = $conn->prepare($insertActorIDQuery);
				$insertActorIDStatement->bind_param("ii", $movieID, $actorID); // Assuming both genreID and movieID are integers
					$insertActorIDStatement->execute();

					if ($insertActorIDStatement->affected_rows > 0) {
						echo "Values successfully inserted into Acts table.";
					} else {
						echo "Error inserting values: " . $insertActorIDStatement->error;
					}

					$insertActorIDStatement->close();

        } else {
            // Error in inserting movie data
            echo "<div class='alert alert-danger' role='alert'>Error in adding movie details.</div>";
        }
    }

    // Close prepared statements
    $checkStatement->close();
	
	$conn->commit();
    echo "Transaction successfully committed.";

} catch (Exception $e) {
    // Rollback the transaction if there's an error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

	
    
    //$insertgenreStatement->close();

    // Close the database connection
    $conn->close();
}
?>


