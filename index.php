<?php
require_once 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the text input from the form
    session_start();
    $_SESSION['username'] = $_POST["nick"];

    $text = $_POST["nick"];

    // Create a new Database instance
    $database = new Database();

    // Get the database connection
    $conn = $database->getConnection();

    // Prepare and execute SQL statement to insert text into the database
    $sql = "INSERT INTO users (nick, status) VALUES ('$text',0)";

    if ($conn->query($sql) === TRUE) {
        echo "Text submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $database->closeConnection();

    header("Location: lobby.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ludo</title>
</head>

<body>
    <h1>WITAJ W CHIŃCZYKU!</h1>
    <form action="" method="post">
        <label for="nick">Twój nick:</label><br>
        <input type="text" id="nick" name="nick"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>