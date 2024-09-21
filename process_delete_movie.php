<?php
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve movieID from the submitted form
    $movieID = $_POST["movieID"];
	try {
    // Start the transaction
    $conn->begin_transaction();	
	
	
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM belongs_to WHERE movieID = ?");
    $stmt->bind_param("s", $movieID);
// Use prepared statements to prevent SQL injection
    $stmt1 = $conn->prepare("DELETE FROM acts WHERE movieID = ?");
    $stmt1->bind_param("s", $movieID);

    $stmt2 = $conn->prepare("DELETE FROM rate WHERE movieID = ?");
    $stmt2->bind_param("s", $movieID);

    
	
	$stmt5 = $conn->prepare("DELETE FROM movie WHERE movieID = ?");
    $stmt5->bind_param("s", $movieID);

    // Execute the delete queries
    if ($stmt->execute() && $stmt1->execute() && $stmt2->execute() ) {
        if ($stmt5->execute() ) {
			echo "Movie and associated records deleted successfully!";
		} else {
			echo "Error deleting records: " . $conn->error;
		}
    } else {
        echo "Error deleting records: " . $conn->error;
    }
	
	

    $stmt->close();
    $stmt1->close();
    $stmt2->close();
    $stmt5->close();

$conn->commit();
    echo "Transaction successfully committed.";

} catch (Exception $e) {
    // Rollback the transaction if there's an error
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
	}
$conn->close();}
?>