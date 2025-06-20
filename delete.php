<?php
include 'config.php'; // Include DB connection

if (isset($_GET['id'])) {
    $TID = $_GET['id']; // Change 'id' to 'TID'
    
    try {
        // Prepare the SQL statement to delete the ticket by TID
        $stmt = $conn->prepare("DELETE FROM student_ticket WHERE TID = :TID");
        $stmt->bindParam(':TID', $TID);
        $stmt->execute();
        echo "Ticket deleted successfully.";
        header("Location: read.php"); // Redirect back to the list after deletion
        exit(); // Ensure the script stops after the redirect
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
