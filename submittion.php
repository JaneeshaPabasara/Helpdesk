<?php
include 'config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket = $_POST['ticket'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    // Handle file upload
    $attachmentPath = '';
    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0) {
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        $fileType = $_FILES['myfile']['type'];

        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = 'uploads/';
            $fileName = basename($_FILES['myfile']['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $targetFilePath)) {
                $attachmentPath = $targetFilePath; // Store the file path in DB
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file type. Only PDF, JPEG, and PNG are allowed.";
        }
    }

    try {
        // Insert data into the database, including the file path
        $stmt = $conn->prepare("INSERT INTO student_ticket (Ttype, subject, Descrip, Priority, Attachment) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ticket, $subject, $description, $priority, $attachmentPath]);

        //echo "New ticket created successfully.";
        header("Location: read.php");
        exit(); // Ensure the script stops after the redirect
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
