<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $Email = isset($_POST['user_email']) ? $_POST['user_email'] : null;
    $passwords = isset($_POST['password']) ? $_POST['password'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;

    // Validate email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email address");
    }



// Validate password
$uppercase = false;
$lowercase = false;
$number = false;
$specialChars = false;

$passwordChars = str_split($passwords);

foreach ($passwordChars as $char) {
    if (ctype_upper($char)) {
        $uppercase = true;
    } elseif (ctype_lower($char)) {
        $lowercase = true;
    } elseif (ctype_digit($char)) {
        $number = true;
    } elseif (!ctype_alnum($char)) {
        $specialChars = true;
    }
}



    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($passwords) < 8) {
        die("Error: Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.");
    }

    // Parameterized query to avoid SQL injection
    $sql = "INSERT INTO Users (passwords, firstName, lastName, Email, username) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssss", $passwords, $firstName, $lastName, $Email, $username);

    if ($stmt->execute()) {
        $_SESSION["username"] = $inputUsername;
        header("Location: userDashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
