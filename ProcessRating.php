<?php
// Check if the form is submitted and the "Search" button is clicked
if (isset($_POST['Search'])) {
   // $type = $_POST['lastClickedButton'];
    $selectbox_data = $_POST['selectbox_data'];

    // Check if the button clicked is "Rating" and the selected option is "Descending"
    if (/*$type === 'Rating' &&*/ $selectbox_data === '2') {
        // Query to retrieve the top 5 movies based on descending order of averageRating
        $sql = "SELECT * FROM Movie ORDER BY averageRating DESC LIMIT 5";
        $result = $conn->query($sql);

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
    } 
	if (/*$type === 'Rating' &&*/ $selectbox_data === '1') {
        // Query to retrieve the top 5 movies based on descending order of averageRating
        $sql = "SELECT * FROM Movie ORDER BY averageRating ASC LIMIT 5";
        $result = $conn->query($sql);

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
}

// Close the database connection
$conn->close();}
?>