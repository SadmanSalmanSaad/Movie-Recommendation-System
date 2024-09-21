<?php
// Start the session
// session_start();

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "movie";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get username and password from the form
//     $inputUsername = $_POST["username"];
//     $inputPassword = $_POST["password"];

//     // Validate the username and password
//     $sql = "SELECT username, passwords FROM Users WHERE username = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("s", $inputUsername);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     if ($user) {
//         // Username exists in the database
//         $backendUsername = $user['username'];
//         $backendPassword = $user['passwords'];

//         // Now you have $backendUsername and $backendPassword for comparison
//         // You can compare $inputUsername with $backendUsername and 
//         // $inputPassword with $backendPassword to authenticate the user

//         if ($inputUsername == $backendUsername && $inputPassword == $backendPassword) {
//             // Authentication successful
//             // Store user information in the session
//             $_SESSION["username"] = $inputUsername;
// 			//echo "login successful!";

//             // Redirect to a protected page or home page
//             header("Location: userDashboard.php");
//             exit();
//         } else {
//             // Authentication failed
//             echo "Invalid username or password. Please try again.";
//         }
//     } else {
//         // Username doesn't exist in the database
//         echo "Invalid username or password. Please try again.";
//     }

//     $stmt->close();
// }

// $conn->close();
// ?>


 <?php
// Start the session
session_start();

// Database connection class
class DatabaseConnection {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function close() {
        $this->conn->close();
    }
}

// User authentication class
class UserAuthenticator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($username, $password) {
        $sql = "SELECT username, passwords FROM Users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && $username == $user['username'] && $password == $user['passwords']) {
            return true;
        }
        return false;
    }
}

// Main application logic
class Application {
    private $db;
    private $authenticator;

    public function __construct($db, $authenticator) {
        $this->db = $db;
        $this->authenticator = $authenticator;
    }

    public function run() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputUsername = $_POST["username"];
            $inputPassword = $_POST["password"];

            if ($this->authenticator->authenticate($inputUsername, $inputPassword)) {
                $_SESSION["username"] = $inputUsername;
                header("Location: userDashboard.php");
                exit();
            } else {
                echo "Invalid username or password. Please try again.";
            }
        }
    }
}

// Dependency Injection
$database = new DatabaseConnection("localhost", "root", "", "movie");
$authenticator = new UserAuthenticator($database->getConnection());
$app = new Application($database, $authenticator);
$app->run();
$database->close();
?>
