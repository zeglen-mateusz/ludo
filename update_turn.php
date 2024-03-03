<?php

// Include the database connection
require_once 'database.php';

// Create a new Database instance
$database = new Database();

// Get the database connection
$conn = $database->getConnection();

// Fetch the current values of 'player1b', 'player2r', 'player3g', and 'player4y' from the 'games' table
$sql = "SELECT player1b, player2r, player3g, player4y FROM games";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check the values of 'player1b', 'player2r', 'player3g', and 'player4y'
    $player1b = $row["player1b"];
    $player2r = $row["player2r"];
    $player3g = $row["player3g"];
    $player4y = $row["player4y"];

    // Update the 'tura' column based on the conditions
    // if ($player1b == "X") {
    //     $newTurn = 2;
    // } elseif ($player2r == "X") {
    //     $newTurn = 3;
    // } elseif ($player3g == "X") {
    //     $newTurn = 4;
    // } elseif ($player4y == "X") {
    //     $newTurn = 1;
    // } else {
    // If none of the conditions are met, increment the current turn
    $sqlCurrentTurn = "SELECT tura FROM games";
    $resultCurrentTurn = $conn->query($sqlCurrentTurn);
    if ($resultCurrentTurn->num_rows > 0) {
        $rowCurrentTurn = $resultCurrentTurn->fetch_assoc();
        $currentTurn = $rowCurrentTurn["tura"];

        $newTurn = ($currentTurn % 4) + 1;

        if ($newTurn == 1 and $player1b == "X") {
            if ($newTurn == 2 and $player2r == "X") {
                $newTurn = 3;
            } else {
                $newTurn = 2;
            }
        } else if ($newTurn == 2 and $player2r == "X") {
            if ($newTurn == 3 and $player3g == "X") {
                $newTurn = 4;
            } else {
                $newTurn = 3;
            }
        } else if ($newTurn == 3 and $player3g == "X") {
            if ($newTurn == 4 and $player4y == "X") {
                $newTurn = 1;
            } else {
                $newTurn = 4;
            }
        } else if ($newTurn == 4 and $player4y == "X") {
            if ($newTurn == 1 and $player1b == "X") {
                $newTurn = 2;
            } else {
                $newTurn = 1;
            }
        }
    } else {
        // If no current turn is found, set the new turn to 1
        $newTurn = 1;
    }


    // }

    // Update query to set 'tura' to the new value
    $sqlUpdate = "UPDATE games SET tura = $newTurn";

    // Execute the update query
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Turn updated successfully";
    } else {
        echo "Error updating turn: " . $conn->error;
    }
} else {
    echo "No rows found";
}

// Close the database connection
$conn->close();

?>