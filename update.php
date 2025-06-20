<?php
include 'config.php'; // Include DB connection

if (isset($_GET['id'])) {
    $TID = $_GET['id']; // Change 'id' to 'TID'
    
    try {
        // Prepare the SQL statement to fetch the ticket details by TID
        $stmt = $conn->prepare("SELECT * FROM student_ticket WHERE TId = :TID");
        $stmt->bindParam(':TID', $TID);
        $stmt->execute();
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TID = $_POST['TID'];
    $ticket = $_POST['ticket'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    try {
        // Update the ticket information based on TID
        $stmt = $conn->prepare("UPDATE student_ticket 
                                SET Ttype = :ticket, subject = :subject, Descrip = :description, Priority = :priority 
                                WHERE TID = :TID");
        $stmt->bindParam(':TID', $TID);
        $stmt->bindParam(':ticket', $ticket);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);

        $stmt->execute();
        echo "Ticket updated successfully.";
        header("Location: read.php");
        exit(); // Ensure the script stops after the redirect
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Ticket</title>
    <link rel="stylesheet" type="text/css" href="styles1/style2.css">
</head>
<body>
<div class="nav">
        
        <div class="row">
            <div class="col-25">
               <img class="logo" src="./image1/logo.png" />
            </div>
            <div class="col-25">
                <h2>ONLINE HELP DESK</h2>
            </div>
        </div>
    
    </div>
    <div class='box'>
    
    <form method="POST" class="container" action="update.php">
        <!-- Use the TID to identify the ticket -->
        <h1>Update Ticket</h1>
        <input type="hidden" name="TID" value="<?= $ticket['TID'] ?>">
        Ticket type:
        <select name="ticket" id="ticket">
            <option value="Technical support" <?= $ticket['Ttype'] == 'Technical support' ? 'selected' : '' ?>>Technical support</option>
            <option value="academic advising" <?= $ticket['Ttype'] == 'academic advising' ? 'selected' : '' ?>>academic advising</option>
            <option value="financial aid" <?= $ticket['Ttype'] == 'financial aid' ? 'selected' : '' ?>>financial aid</option>
        </select><br><br>

        Subject:<input type="text" name="subject" value="<?= $ticket['subject'] ?>"><br><br>

        Description:<br>
        <textarea name="description" rows="5"><?= $ticket['Descrip'] ?></textarea><br><br>

        Priority:
        <select name="priority" id="priority">
            <option value="low" <?= $ticket['Priority'] == 'low' ? 'selected' : '' ?>>low</option>
            <option value="medium" <?= $ticket['Priority'] == 'medium' ? 'selected' : '' ?>>medium</option>
            <option value="High" <?= $ticket['Priority'] == 'High' ? 'selected' : '' ?>>High</option>
        </select><br><br>

        <input type="submit" value="Update">
        <br><br>
    </form></div>
</body>
</html>
