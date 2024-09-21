<!-- <?php
// Start the session
// session_start();


// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get username and password from the form
//     $inputUsername = $_POST["username"];
//     $inputPassword = $_POST["password"];

//     // Validate the username and password
    
//         $backendUsername = 'root';
//         $backendPassword = '12345678';

//         // Now you have $backendUsername and $backendPassword for comparison
//         // You can compare $inputUsername with $backendUsername and 
//         // $inputPassword with $backendPassword to authenticate the user

//         if ($inputUsername == $backendUsername && $inputPassword == $backendPassword) {
//             // Authentication successful
//             // Store user information in the session
//             $_SESSION["username"] = $inputUsername;
// 			//echo "login successful!";

//             // Redirect to a protected page or home page
//             header("Location: adminDashboard.php");
//             exit();
//         } else {
//             // Authentication failed
//             echo "Invalid username or password. Please try again.";
//         }
//     } else {
//         // Username doesn't exist in the database
//         echo "Invalid username or password. Please try again.";
//     }

// ?>
 -->

 <?php
// Start the session
session_start();

// Interface for Authentication
interface Authenticator {
    public function authenticate($username, $password);
}

// Class for handling hardcoded user authentication
class HardcodedAuthenticator implements Authenticator {
    private $username = 'root';
    private $password = '12345678';

    public function authenticate($username, $password) {
        return $username === $this->username && $password === $this->password;
    }
}

// Class for handling application logic
class Application {
    private $authenticator;

    public function __construct(Authenticator $authenticator) {
        $this->authenticator = $authenticator;
    }

    public function run() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputUsername = $_POST["username"];
            $inputPassword = $_POST["password"];

            if ($this->authenticator->authenticate($inputUsername, $inputPassword)) {
                $_SESSION["username"] = $inputUsername;
                header("Location: adminDashboard.php");
                exit();
            } else {
                echo "Invalid username or password. Please try again.";
            }
        }
    }
}

// Dependency Injection
$authenticator = new HardcodedAuthenticator();
$app = new Application($authenticator);
$app->run();
?>

