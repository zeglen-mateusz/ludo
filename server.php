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
        $sql1 = "SELECT nick, status FROM users";

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

        // Second SQL query to select count of "status" where status = 1
        $sql2 = "SELECT COUNT(status) AS total_status FROM users WHERE status = 1";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            // Fetch associative array of result
            $data2 = $result2->fetch_assoc();
        } else {
            $data2 = [];
        }

        // Third SQL query to select count of "status"
        $sql3 = "SELECT COUNT(status) AS total_status FROM users";

        $result3 = $conn->query($sql3);

        if ($result3->num_rows > 0) {
            // Fetch associative array of result
            $data3 = $result3->fetch_assoc();
        } else {
            $data3 = [];
        }
        if ($data2['total_status'] == 2) {
            $data4 = 1;
        } else if ($data3['total_status'] == 4) {
            $data4 = 1;
        } else {
            $data4 = 0;
        }
        // Close connection
        $conn->close();

        // Combine data into a single array
        $data = [
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
        ];

        // Output data as JSON
        echo json_encode(['data' => $data]);
    }
}

// Create an instance of UserDataFetcher
$userDataFetcher = new UserDataFetcher();

// Fetch and output data
$userDataFetcher->fetchData();
?>