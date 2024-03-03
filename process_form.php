<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $text = $_POST["nick"];

    // Validate the input if necessary
    // For example, check if the text is not empty

    // Database connection configuration
    $hostname = "localhost"; // Change this to your database hostname
    $username = "username"; // Change this to your database username
    $password = "password"; // Change this to your database password
    $database = "database"; // Change this to your database name

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert text into the database
    $sql = "INSERT INTO text_table (text_column) VALUES ('$text')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Text submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>