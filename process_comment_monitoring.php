<?php
include "adminHeader.php";
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve movieID from the submitted form
    $movieID = $_POST["movieID"];

    // Fetch movie details based on the movieID
    $sql = "SELECT * FROM Movie WHERE movieID = $movieID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<div class="col text-center">
    <h1 style="color:white;">Update Comment of: <?php echo $row["movieName"]; ?></h1>
</div>

<div style="background-color:#B80000; margin:70px; padding:20px;">
    <form class="row g-3" style="background-color:#B80000;" method="post" action="process_update_movie_2.php" enctype="multipart/form-data">
	<input type="hidden" class="form-control" name="movieID" value="<?php echo $movieID; ?>">
        <div class="col-md-6" style="color:white;">
            <label for="newMovieName" class="form-label">Movie Name</label>
            <input type="text" class="form-control" name="newMovieName" value="<?php echo $row["movieName"]; ?>" id="movieName" placeholder="Enter Movie Name" required>
        </div>
        <div class="col-md-6" style="color:white;">
            <label for="ReleaseDate" class="form-label">Release Date</label>
            <input type="datetime-local" id="ReleaseDate" name="newReleaseDate" value="<?php echo $row["releaseDate"]; ?>" class="form-control" placeholder="Enter Release Date" required>
        </div>
        <div class="col-md-6" style="color:white;">
            <label for="director" class="form-label">Director Name</label>
            <input type="text" class="form-control" name="newDirectorName" value="<?php echo $row["director"]; ?>" id="director" placeholder="Enter Director Name" required>
        </div>
 
		<div class="col-md-6" style="color:white;">
			<label for="newDescriptions" class="form-label">Comment</label>
			<textarea class="form-control" id="description" name="newDescriptions" placeholder="Enter the Description of the Movie" required><?php echo $row["Descriptions"]; ?></textarea>
		</div>
    </div>

    <div style="background-color:black; margin:20px;">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <input type="submit" name="Search" class="button" value="Update" style="width: 120px; background-color:#cf0300; border-radius: 20px; color: white" />
                </div>
            </div>
        </div>
    </div>
</form>

        
<?php
    } else {
        echo "Movie not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
include "footer.php";
?>
