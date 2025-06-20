<?php
include 'config.php'; // Include DB connection

try {
    $stmt = $conn->query("SELECT * FROM student_ticket");
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Help Desk - View Tickets</title>
    <link rel="stylesheet" type="text/css" href="styles1/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    
           <ul class="menu">
            <li class="menu"><a href="index1.html">Home</a></li>
            <li class="menu"><a href="student.html">Student</a></li>
            <li class="menu"><a href="FaQ.html">FaQ</a></li>
            <li class="menu"><a href="about.html">About</a></li>
        </ul>
    </div>
    <h1>Submitted Tickets</h1>
    <table border="1" id="std">
        <tr>
            <th>ID</th>
            <th>Ticket Type</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Attachment</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><?= $ticket['TID'] ?></td>
            <td><?= $ticket['Ttype'] ?></td>
            <td><?= $ticket['subject'] ?></td>
            <td><?= $ticket['Descrip'] ?></td>
            <td><?= $ticket['Priority'] ?></td>
            <td>
                <?php if (!empty($ticket['attachments'])): ?>
                    <?php 
                        $fileExtension = pathinfo($ticket['attachments'], PATHINFO_EXTENSION);
                        if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])): 
                    ?>
                        <img src="<?= $ticket['attachments'] ?>" alt="Attachments" width="100">
                    <?php elseif ($fileExtension == 'pdf'): ?>
                        <a href="<?= $ticket['attachments'] ?>" target="_blank">View PDF</a>
                    <?php else: ?>
                        incorrect Attachment
                    <?php endif; ?>
                <?php else: ?>
                    No Attachment
                <?php endif; ?>
            </td>
            <td>
            <a href="update.php?id=<?= $ticket['TID'] ?>" title="Edit">
    <i class="fas fa-edit"></i>
</a>
<a href="delete.php?id=<?= $ticket['TID'] ?>" title="Delete">
    <i class="fas fa-trash"></i>
</a>

                </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
