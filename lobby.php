<?php
session_start();
$myVariable = $_SESSION['username'];
setcookie("nick", $myVariable, time() + 3600, "/"); // Cookie expires in 1 hour
?>

<!DOCTYPE html>
<html>

<head>
    <title>LOBBY</title>

    <style>
        input[type="checkbox"] {
            display: none;
        }

        /* Style the label to look like a button */
        .button-label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333333;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Change button style when checkbox is checked */
        input[type="checkbox"]:checked+.button-label {
            background-color: #28a745;
            /* Change color when checked */
        }

        .ready {
            border: 1px solid green;
            margin: 10px;
        }

        .notready {
            border: 1px solid red;
            margin: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Get the value of the cookie and store it in a JavaScript variable


        $(document).ready(function () {
            $('#statusSwitch').change(function () {
                console.log("siuu")
                var status = this.checked ? 1 : 0; // 1 for checked, 0 for unchecked
                $.ajax({
                    url: 'update_status.php',
                    type: 'POST',
                    data: { status: status, nick: getCookie("nick") },
                    success: function (response) {
                        console.log("siuu")
                        $('#statusMessage').text(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Function to send AJAX request and update UI
            function fetchData() {
                var myNick = getCookie("nick");
                console.log("Value of myVariable in JavaScript:", myNick);
                $.ajax({
                    url: 'server.php', // URL of the PHP script
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.data.data4 == 1) {
                            window.location.href = "board.php";
                        }
                        // Update UI with received data
                        $('#data-container').empty(); // Clear previous data
                        response.data.data1.forEach(function (item) {
                            if (myNick == item.nick) {
                                if (item.status == 1) {
                                    $('#data-container').append('<div class="ready">' + item.nick + ' - ' + item.status + '⬅TY</div>');
                                }
                                else {
                                    $('#data-container').append('<div class="notready">' + item.nick + ' - ' + item.status + '⬅TY</div>');
                                }
                            }
                            else {
                                if (item.status == 1) {
                                    $('#data-container').append('<div class="ready">' + item.nick + ' - ' + item.status + '</div>');
                                }
                                else {
                                    $('#data-container').append('<div class="notready">' + item.nick + ' - ' + item.status + '</div>');
                                }
                            }
                        });
                        $('#data-container2').empty();
                        var data2 = response.data.data2;
                        console.log(response.data.data2.total_status)
                        // Iterate over the data and display it
                        // response.data2.forEach(function (item) {
                        $('#data-container2').append('<div>' + response.data.data2.total_status + "/" + response.data.data3.total_status + ' ready</div>');
                        // });


                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Fetch data initially when the page loads
            fetchData();


            setInterval(fetchData, 1000);
        });


    </script>
</head>

<body>
    <h1>Lobby</h1>
    <?php

    echo "Username: " . $_SESSION['username'] . "<br>";
    ?>
    <h2>Gracze</h2>
    <div id="data-container">Loading...</div>
    <div id="data-container2">Loading...</div>
    <label class="switch">
        <input type="checkbox" id="statusSwitch">
        <label for="statusSwitch" class="button-label">PLAY</label>
        <span class="slider"></span>
    </label>
    <div id="statusMessage"></div>

</body>

</html>