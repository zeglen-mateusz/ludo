<?php

require_once 'database.php';

class UserDataFetcher
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function fetchData()
    {
        $conn = $this->database->getConnection();

        // First SQL query to select "nick" and "status" columns
        $sql3 = "UPDATE users SET status = 2 where status <2";
        $conn->query($sql3);

        $sql1 = "SELECT nick, status FROM users where status >=2";

        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            // Fetch associative array of results
            $data1 = array();
            while ($row = $result1->fetch_assoc()) {
                $data1[] = $row;
            }
        } else {
            $data1 = [];
        }


        $sql2 = "SELECT COUNT(nick) AS total_users FROM users where status =2";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Fetch the row from the result
            $row = $result2->fetch_assoc();

            // Retrieve the count of users with status 2
            $totalUsersWithStatus2 = $row['total_users'];






            $statusNumbers = [31, 32, 33, 34];

            // Przetasuj numery statusów
            shuffle($statusNumbers);

            // Pobierz listę ID użytkowników z aktualnym statusem 2
            $sql = "SELECT id FROM users WHERE status = 2 LIMIT 4";
            $result = $conn->query($sql);

            // Sprawdź, czy są dostępni użytkownicy do aktualizacji
            if ($result->num_rows > 0) {
                $userIDs = [];
                // Pobierz ID użytkowników z wyników zapytania
                while ($row = $result->fetch_assoc()) {
                    $userIDs[] = $row['id'];
                }

                // Przypisz losowe statusy do każdego użytkownika
                foreach ($userIDs as $userID) {
                    // Wybierz losowy indeks z przetasowanej tablicy statusów
                    $randomIndex = array_rand($statusNumbers);
                    // Wybierz status dla danego indeksu
                    $randomStatus = $statusNumbers[$randomIndex];

                    // Aktualizuj status dla danego użytkownika
                    $sqlUpdate = "UPDATE users SET status = ? WHERE id = ?";
                    $stmt = $conn->prepare($sqlUpdate);
                    $stmt->bind_param("ii", $randomStatus, $userID);
                    $stmt->execute();
                    $stmt->close();

                    // Usuń przypisany status z tablicy, aby uniknąć przypisania go ponownie
                    unset($statusNumbers[$randomIndex]);
                }


                $statusNumber = 31;
                $sql = "SELECT nick FROM users WHERE status = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $statusNumber);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch associative array of results
                    while ($row = $result->fetch_assoc()) {
                        // Output nick of the user
                        $nick1 = $row['nick'];
                    }
                } else {
                    $statusNumber = 32;
                    $sql = "SELECT nick FROM users WHERE status = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $statusNumber);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    // Check if there are rows returned
                    if ($result->num_rows > 0) {
                        // Fetch associative array of results
                        while ($row = $result->fetch_assoc()) {
                            // Output nick of the user
                            $nick1 = $row['nick'];
                        }
                    }
                }

                $statusNumber = 32;
                $sql = "SELECT nick FROM users WHERE status = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $statusNumber);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch associative array of results
                    while ($row = $result->fetch_assoc()) {
                        // Output nick of the user
                        $nick2 = $row['nick'];
                    }
                }
                $statusNumber = 33;
                $sql = "SELECT nick FROM users WHERE status = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $statusNumber);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch associative array of results
                    while ($row = $result->fetch_assoc()) {
                        // Output nick of the user
                        $nick3 = $row['nick'];
                    }
                }
                $statusNumber = 34;
                $sql = "SELECT nick FROM users WHERE status = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $statusNumber);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if there are rows returned
                if ($result->num_rows > 0) {
                    // Fetch associative array of results
                    while ($row = $result->fetch_assoc()) {
                        // Output nick of the user
                        $nick4 = $row['nick'];
                    }
                }


                $player1b = !empty($nick1) ? $nick1 : "X";
                $player2r = !empty($nick2) ? $nick2 : "X";
                $player3g = !empty($nick3) ? $nick3 : "X";
                $player4y = !empty($nick4) ? $nick4 : "X";
                var_dump($player1b, $player2r, $player3g, $player4y);
                // Zapytanie SQL z przygotowanymi wartościami lub NULL
                $sql = "INSERT INTO `games` 
        (`ID`, `player1b`, `player2r`, `player3g`, `player4y`, 
        `player1b1`, `player1b2`, `player1b3`, `player1b4`, 
        `player2r1`, `player2r2`, `player2r3`, `player2r4`, 
        `player3g1`, `player3g2`, `player3g3`, `player3g4`, 
        `player4y1`, `player4y2`, `player4y3`, `player4y4`, 
        `tura`, `koniec`) 
        VALUES 
        (NULL, ?, ?, ?, ?, '-1', '-2', '-3', '-4', '-5', '-6', '-7', '-8', '-9', '-10', '-11', '-12', '-13', '-14', '-15', '-16', '1', '0')";

                // Przygotowanie i wykonanie zapytania
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $player1b, $player2r, $player3g, $player4y);
                $stmt->execute();



            }

        }



        $sql2 = "SELECT * FROM games";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Fetch associative array of results
            $data2 = array();
            while ($row = $result2->fetch_assoc()) {
                $data2[] = $row;
            }
        } else {
            $data2 = [];
        }

        // Combine data into a single array
        $data = [
            'data1' => $data1,
            'data2' => $data2,
        ];
        $conn->close();
        echo json_encode(['data' => $data]);

    }
}



// Create an instance of UserDataFetcher
$userDataFetcher = new UserDataFetcher();

// Fetch and output data
$userDataFetcher->fetchData();
?>