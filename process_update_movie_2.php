<?php
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve movieID and updated details from the submitted form
    $movieID = $_POST["movieID"];
    $newMovieName = $_POST["newMovieName"];
    $newDescriptions = $_POST["newDescriptions"];
    $newReleaseDate = $_POST["newReleaseDate"];
    $newDirectorName = $_POST["newDirectorName"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE Movie SET movieName = ?, Descriptions = ?,director=? ,releaseDate=? WHERE movieID = ?");
    $stmt->bind_param("ssssi", $newMovieName, $newDescriptions,$newDirectorName,$newReleaseDate,$movieID);

    // Execute the update query
    if ($stmt->execute()) {
        echo "Movie updated successfully!";
    } else {
        echo "Error updating movie: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
