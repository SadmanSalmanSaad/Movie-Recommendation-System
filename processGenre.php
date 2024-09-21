<!?php
  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button was clicked last
    $lastClickedButton = isset($_POST['lastClickedButton']) ? $_POST['lastClickedButton'] : '';
    if (isset($_POST['Search'])) {
        // Check if the last clicked button was Genre
        if ($lastClickedButton === 'submitGenre') {
            // Code to handle search after Genre button click
            echo 'Genre button clicked!';
        } elseif ($lastClickedButton === 'submitRating') {
        // Code to handle Rating button click
        
		} elseif ($lastClickedButton === 'submitActor') {
        // Code to handle Actor button click
        
        }
    }
}
?>

  <?php
  
  /*
  
  Gnre type=type----------   read gid
belongs to MID read       -----------sathe sathe fetch 
movie details from movie table

  
  */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Handle form submission
$genre = isset($_POST['selectbox_data']) ? $_POST['selectbox_data'] : null;
	if ($genre != null) {
			$selectedGtype=$_POST['selectbox_data'];
			 
		
		// Gnre type=type----------   read gid
    // Fetch genreID based on the selected Gtype
    $sql = "SELECT genreID FROM Genre WHERE Gtype = '$selectedGtype'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $selectedGenreID = $row['genreID'];

        // Display the selected Gtype and genreID
        //echo '<div class="result">';
        //echo '<p>Selected Genre: ' . $selectedGtype . '</p>';
        //echo '<p>Corresponding genreID: ' . $selectedGenreID . '</p>';
        //echo '</div>';
    } else {
        echo '<p>No matching record found.</p>';
    }
	
	
	//belongs to MID read       -----------sathe sathe fetch 
	 $sql = "SELECT movieID FROM belongs_to WHERE genreID = '$selectedGenreID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movieID = $row['movieID'];

        // Display the selected Gtype and genreID
        //echo '<div class="result">';
        //echo '<p>Selected movieID: ' . $movieID . '</p>';
        //echo '</div>';
    } else {
        echo '<p>No matching record found.</p>';
    }
	
	$query ="SELECT m.movieID,m.movieName,m.Descriptions,m.averageRating,m.releaseDate,m.director
          FROM Movie AS m
          JOIN Belongs_to AS b ON m.movieID= b.movieID
           AND b.genreID IN (SELECT genreID FROM Genre WHERE Gtype = ?)";
	
	//movie details from movie table
	$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selectedGtype);
$stmt->execute();

$result = $stmt->get_result();
// Display the results
if ($result->num_rows > 0) {
    echo '<div class="row">';

    while ($row = $result->fetch_assoc()) {
        $movieID = $row["movieID"];
        $imageSrc = "images/Movies/$movieID.jpg";

        echo '<div class="col-lg-2 col-md-6 image-container">';
        echo '<img src="' . $imageSrc . '" alt="Movie Image">';
        echo '<div class="image-details">';
        echo '<h5>' . $row["movieName"] . '</h5>';
        echo '<p>' . "Descriptions : ". $row["Descriptions"] . '</p>';
        echo '<p>' ."Average Rating: " . $row["averageRating"] . "<br>". '</p>';
        echo '<p>' . "Release Date: " . $row["releaseDate"] . "<br>". '</p>';
        echo '<p>' . "Director: " . $row["director"] . "<br><br>" . '</p>';
		
        echo '</div></div>';
    }

    echo '</div>';
} else {
    echo "No movies found.";
}


$stmt->close();


/*


//rating basis a search:

$stmt = $conn->prepare("SELECT * FROM movies ORDER BY averageRating DESC LIMIT 5");
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["movieID"] . "</td>";
        echo "<td>" . $row["Descriptions"] . "</td>";
        echo "<td>" . $row["averageRating"] . "</td>";
        echo "<td>" . $row["releaseDate"] . "</td>";
        echo "<td>" . $row["director"] . "</td>";
        echo "<td>" . $row["movieName"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

$stmt->close();
		
*/	
	}
}

?>