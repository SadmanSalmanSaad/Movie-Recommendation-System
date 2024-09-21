<?php
	include "db_connection.php"; // Include your database configuration file
	$rate = 0;
	$movieID=0;
	$userID=0;
	session_start();
					// Retrieve the username from the session
					$username = $_SESSION["username"];
// Check if the form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
		$movieName = $_POST["movieName"];
		$releaseDate = $_POST["ReleaseDate"];
		$Description = $_POST["Description"];
		
		
	
			try {
    // Start the transaction
    $conn->begin_transaction();	

    // SQL query to retrieve actorID based on actorName
		$sql = "SELECT userID FROM users WHERE userName = '$username'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
				// ActorName found in the database, fetch and print actorID
				$row = $result->fetch_assoc();
				$userID = $row['userID'];
				
				
				$checkQuery = "SELECT * FROM Movie WHERE movieName = ?";
				$checkStatement = $conn->prepare($checkQuery);
				$checkStatement->bind_param("s", $movieName);
				$checkStatement->execute();
				$result = $checkStatement->get_result();
				
				
				
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$movieID = $row['movieID'];
				// Determine the selected rating and assign it to $rate
					if (isset($_POST["rate"])) {
						switch ($_POST["rate"]) {
							case '5':
								$rate = 5;
								break;
							case '4':
								$rate = 4;
								break;
							case '3':
								$rate = 3;
								break;
							case '2':
								$rate = 2;
								break;
							case '1':
								$rate = 1;
								break;
							default:
                    // Default case, do nothing
						}
					}
				// Add your database insertion logic here
					$insertQuery = "INSERT INTO rate (movieID, userID,rating,lastView,Comment) VALUES (?, ?, ?, ?, ?)";
					$insertStatement = $conn->prepare($insertQuery);
					$insertStatement->bind_param("iidss", $movieID,$userID,$rate,$releaseDate ,$Description); // Assuming both genreID and movieID are integers
					$insertStatement->execute();

					if ($insertStatement->affected_rows > 0) {
						echo "Values successfully inserted into belongs_to table.";
					} else {
						echo "Error inserting values: " . $insertStatement->error;
					}

					$insertStatement->close();	
					echo "ActorName: $userID matches. ActorID: $userID";
					echo "<div><p>Movie Name: $movieName</p><br>";
					echo "Release Date: $releaseDate<br>";
					echo "Description: $Description<br>";
					echo "Movie Name: $movieName<br>";
					echo "Release Date: $releaseDate<br>";
					echo "Description: $Description<br>";
					echo "Rating: $rate $username $movieID stars<br>";
				} else {
				// ActorName not found in the database
				echo "This $movieName Movie does not exist in the database.Add movie first";
			}
			        
	}	
	$conn->commit();
    echo "Transaction successfully committed.";

} catch (Exception $e) {
    // Rollback the transaction if there's an error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
	}}
	
?>


