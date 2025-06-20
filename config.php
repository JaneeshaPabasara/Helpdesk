<?php
$serverName = "MySQL:3306"; // Replace with your SQL Server instance name if necessary
$username = "root"; // Your SQL Server username
$password = ""; // Your SQL Server password
$db = "helpdesk"; // Your database name

// DSN for SQL Server
$dsn = "sqlsrv:Server=$serverName;Database=$db";

try {
    // Create a new PDO instance
    $conn = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!";
    
    // You can add your database operations here

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Optionally close the connection
$con = null;
?>
