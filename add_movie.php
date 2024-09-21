<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            color: white;
            padding: 25px;
            background-color: black;
        }

        h1 {
            padding-bottom: 15px;
        }

        .alert {
            margin-top: 25px;
        }

        .card-container {
            background-color: #920000;
            margin: 70px;
            padding: 20px;
        }

        .form-label {
            color: white;
        }

        .button {
            width: 120px;
            background-color: #920000
            border-radius: 20px;
            color: white;
        }

        .form-control {
            background-color:#920000;
            color: white;
            border: 1px solid white;
        }

        .file-input {
            color: white;
            border: 1px solid white;
        }

        .file-input:focus {
            border-color: white;
        }

        .card-header {
            background-color:#920000;
            color: white;
        }

        .card {
            background-color: #920000;
            border: 1px solid white;
            border-radius: 10px;
        }
		.card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }
		
    </style>
    <title>Add Movie Details</title>
</head>
<body>
<?php include "adminHeader.php"; ?>

<div class="col text-center">
    <h1 style="color:white;">Add Movie Details</h1>
</div>

<div class="card-container">
    <form class="row g-3" method="post" action="processAddMovie.php" enctype="multipart/form-data">
        <div class="col-md-6">
            <div class="card" style="background-color:#920000;">
                <div class="card-header" style="background-color:#920000;">
                    <h5 class="mb-0" style="color:white;">Basic Details</h5>
                </div>
                <div class="card-body" style="background-color:#920000;">
                    <label for="movieName" class="form-label">Movie Name</label>
                    <input type="text" class="form-control" name="movieName" id="movieName" placeholder="Enter Movie Name" required>

                    <label for="ReleaseDate" class="form-label mt-3">Release Date</label>
                    <input type="datetime-local" id="ReleaseDate" name="ReleaseDate" class="form-control" placeholder="Enter Release Date" required>

                    <label for="director" class="form-label mt-3">Director Name</label>
                    <input type="text" class="form-control" name="director" id="director" placeholder="Enter Director Name" required>

                    <label for="actor" class="form-label mt-3">Actor Name</label>
                    <input type="text" class="form-control" name="actor" id="actor" placeholder="Enter Actor Name" required>

                    
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="background-color:#920000;">
                <div class="card-header" style="background-color:#920000;">
                    <h5 class="mb-0" style="color:white;">Additional Details</h5>
                </div>
                <div class="card-body" style="background-color:#920000;">
                    <label for="formFile" class="form-label">Movie Image</label>
                    <input class="form-control file-input" type="file" name="fileToUpload" id="formFile" required>

                    <label for="description" class="form-label mt-3">Description</label>
                    <textarea class="form-control" id="description" name="Description" placeholder="Enter the Description of the Movie" required></textarea>
					
					<label for="genre" class="form-label mt-3">Genre</label>
                    <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter Genre" required>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card" style="background-color:#920000;">
                <div class="card-header" style="background-color:#920000;">
                    <h5 class="mb-0" style="color:white;">Submit</h5>
                </div>
                <div class="card-body text-center">
                    <input type="submit" name="Search" class="button" value="ADD" style="background-color:#920000;">
                </div>
            </div>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>

