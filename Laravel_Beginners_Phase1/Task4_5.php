<?php
// Include the database connection file
require_once("connec.php");

// Get data from the form
$name = $_POST["name"];
$email = $_POST["email"];

// Insert data into the database
$sql = "INSERT INTO Users (name, email) VALUES ('$name', '$email')";

if ($conn->query($sql) === TRUE) {
    
    echo  "New record created successfully, '$name','$email'";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
