
<?php
// Assuming you have a database connection named $conn

if (isset($_POST['Search'])) {
    //$type = isset($_POST['selectbox_data']) ? $_POST['selectbox_data'] : '';

    //if (!empty($type)) {
        //if ($type === 'Actor') {
            $actorName = $_POST['selectbox_data'];

            // Get actorID from Actor table based on actorName
            $sql = "SELECT m.movieID,m.movieName,m.Descriptions,m.averageRating,m.releaseDate,m.director
								FROM Movie AS m
								JOIN acts AS ac ON m.movieID= ac.movieID
								AND ac.actorID IN (SELECT actorID FROM actor WHERE actorName = '$actorName')";
            $result = $conn->query($sql);

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
        //}
        // Add similar logic for other search types (Genre, Rating) if needed
    /*} else {
        echo 'Please select a search type.';
    }*/
}
?>