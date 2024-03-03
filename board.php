<?php
session_start();
$myVariable = $_SESSION['username'];
echo $myVariable;
setcookie("nick", $myVariable, time() + 3600, "/"); // Cookie expires in 1 hour
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ludo Board</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        .buttonr {
            width: 20px;
            height: 20px;
            background-color: crimson;
            border-radius: 50%;
            cursor: pointer;
        }

        .buttonr:hover {
            background-color: darkred;
        }

        .buttony {
            width: 20px;
            height: 20px;
            background-color: lightyellow;
            border-radius: 50%;
            cursor: pointer;
        }

        .buttonry:hover {
            background-color: darkgoldenrod;
        }

        .buttong {
            width: 20px;
            height: 20px;
            background-color: lightgreen;
            border-radius: 50%;
            cursor: pointer;
        }

        .buttong:hover {
            background-color: darkgreen;
        }

        .buttonb {
            width: 20px;
            height: 20px;
            background-color: lightskyblue;
            border-radius: 50%;
            cursor: pointer;
        }

        .buttonb:hover {
            background-color: darkblue;
        }

        .die-face {
            width: 120px;
            height: 120px;
            border: 1px solid #555;
            background-color: #fff;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            animation: rollAnimation 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            transform-style: preserve-3d;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
        }

        /* Define styles for the dots */
        .dot {
            width: 25%;
            height: 25%;
            background-color: #000;
            border-radius: 50%;
            margin: 3px;
            opacity: 0.8;
        }

        /* Define the roll animation */
        @keyframes rollAnimation {
            0% {
                transform: rotateX(360deg) rotateY(0deg) rotateZ(0deg);
            }

            100% {
                transform: rotateX(0deg) rotateY(0deg) rotateZ(360deg);
            }
        }

        /* Define styles for the Ludo board */
        table {
            border-collapse: collapse;
            margin: auto;
        }

        tr {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }

        td {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
            width: 50px;
            height: 50px;
            border: 1px solid black;
            text-align: center;
            font-weight: bold;
        }

        /* Define colors for different regions of the board */
        .red {
            background-color: red;
            color: white;

        }

        .green {
            background-color: green;
            color: white;
        }

        .yellow {
            background-color: yellow;
        }

        .blue {
            background-color: blue;
            color: white;
        }

        .gray {
            background-color: gray;
            color: white;
        }
    </style>
</head>

<body>
    <div>

        <div class="container" id="container"></div>
        <h2>Gracze</h2>
        <div id="data-container">Loading...</div>

        <div id="twojKolor"></div>

        <h1>Die Roll</h1>
        <button id="roll" onclick="rollDie()">Roll Die</button>
        <div id="dieResult"></div>
    </div>
    <div>
        <h1>Ludo Board</h1>
        <h2 id="yourTurn"></h2>
        <div id="timer"></div>
        <button id="startStopBtn">Start</button>
        <h2 id="kogoTura">TURA:</h2>
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td id="1" class="gray">1</td>
                <td id="2" class="gray">2</td>
                <td id="3" class="gray">3</td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td id="-1" class="blue">-1</td>
                <td></td>
                <td id="-2" class="blue">-2</td>
                <td></td>

                <td id="48" class="gray">48</td>
                <td id="rbase1" class="red">rb1</td>
                <td id="4" class="red">4</td>
                <td></td>

                <td id="-5" class="red">-5</td>
                <td></td>
                <td id="-6" class="red">-6</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td id="p1"></td>

                <td></td>
                <td></td>
                <td id="47" class="gray">47</td>
                <td id="rbase2" class="red">rb2</td>
                <td id="5" class="gray">5</td>
                <td></td>
                <td></td>

                <td id="p2"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td id="-3" class="blue">-3</td>
                <td></td>
                <td id="-4" class="blue">-4</td>

                <td></td>
                <td id="46" class="gray">46</td>
                <td id="rbase3" class="red">rb3</td>
                <td id="6" class="gray">6</td>

                <td></td>
                <td id="-7" class="red">-7</td>
                <td></td>
                <td id="-8" class="red">-8</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>
                <td id="45" class="gray">45</td>
                <td id="rbase4" class="red">rb4</td>
                <td id="7" class="gray">7</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td id="39" class="gray">39</td>
                <td id="40" class="blue">40</td>
                <td id="41" class="gray">41</td>
                <td id="42" class="gray">42</td>
                <td id="43" class="gray">43</td>
                <td id="44" class="gray">44</td>

                <td></td>

                <td id="8" class="gray">8</td>
                <td id="9" class="gray">9</td>
                <td id="10" class="gray">10</td>
                <td id="11" class="gray">11</td>
                <td id="12" class="gray">12</td>
                <td id="13" class="gray">13</td>
            </tr>
            <tr>
                <td id="38" class="gray">38</td>
                <td id="bbase1" class="blue">bb1</td>
                <td id="bbase2" class="blue">bb2</td>
                <td id="bbase3" class="blue">bb3</td>
                <td id="bbase4" class="blue">bb4</td>
                <td></td>
                <td></td>
                <td></td>
                <td id="gbase4" class="green">gb4</td>
                <td id="gbase3" class="green">gb3</td>
                <td id="gbase2" class="green">gb2</td>
                <td id="gbase1" class="green">gb1</td>
                <td id="14" class="gray">14</td>

            </tr>
            <tr>
                <td id="37" class="gray">37</td>
                <td id="36" class="gray">36</td>
                <td id="35" class="gray">35</td>
                <td id="34" class="gray">34</td>
                <td id="33" class="gray">33</td>
                <td id="32" class="gray">32</td>

                <td></td>

                <td id="20" class="gray">20</td>
                <td id="19" class="gray">19</td>
                <td id="10" class="gray">18</td>
                <td id="17" class="gray">17</td>
                <td id="16" class="green">16</td>
                <td id="15" class="gray">15</td>
            </tr>

            <tr>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>
                <td id="31" class="gray">31</td>
                <td id="ybase4" class="yellow">yb4</td>
                <td id="21" class="gray">21</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>

            <tr>
                <td></td>
                <td id="-13" class="yellow">-13</td>
                <td></td>
                <td id="-14" class="yellow">-14</td>

                <td></td>
                <td id="30" class="gray">30</td>
                <td id="ybase3" class="yellow">yb3</td>
                <td id="22" class="gray">22</td>

                <td></td>
                <td id="-9" class="green">-9</td>
                <td></td>
                <td id="-10" class="green">-10</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td id="p4"></td>

                <td></td>
                <td></td>
                <td id="29" class="gray">29</td>
                <td id="ybase2" class="yellow">yb2</td>
                <td id="23" class="gray">23</td>
                <td></td>
                <td></td>

                <td id="p3"></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td></td>

                <td id="-15" class="yellow">-15</td>
                <td></td>
                <td id="-16" class="yellow">-16</td>
                <td></td>

                <td id="28" class="yellow">28</td>
                <td id="ybase1" class="yellow">yb1</td>
                <td id="24" class="gray">24</td>
                <td></td>

                <td id="-11" class="green">-11</td>
                <td></td>
                <td id="-12" class="green">-12</td>
                <td></td>
            </tr>






            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td id="27" class="gray">27</td>
                <td id="26" class="gray">26</td>
                <td id="25" class="gray">25</td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
            </tr>





        </table>
    </div>

</body>
<script defer>
    var timerElement = document.getElementById("timer");


    var isRunning = false;
    var interval;
    var seconds = 20;
    var tura = 4;
    var pustaTura1 = 0;
    var pustaTura2 = 0;
    var twojaTura = 0;
    var ruchWykonany = 0;
    var rzut;
    function updateTimer() {
        if (seconds > 0) {
            timerElement.textContent = seconds;
            seconds--;
        } else {
            clearInterval(interval);
        }
    }

    function startTimer() {
        if (!isRunning) {
            isRunning = true;
            interval = setInterval(updateTimer, 1000);
        }
    };
    function move(poruszony) {
        console.log("ruszyles sie pinonkiem: " + poruszony)
        if (ruchWykonany == 1) {





            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_turn.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    // Response from the server
                    console.log(xhr.responseText);
                }
            };
            xhr.send();
        }


    }

    function rollDie() {
        // Disable button during animation
        isRunning = false;


        console.log(tura)
        tura = tura + 1;
        if (tura == 5) {
            tura = 0
        }
        document.getElementById("roll").disabled = true;
        // Simulate rolling a die to get a random number between 1 and 6
        var result = Math.floor(Math.random() * 6) + 1;
        rzut = result
        ruchWykonany = 1

        // Display the result with the appropriate number of dots after a short delay
        setTimeout(function () {
            var dots = "";
            for (var i = 0; i < result; i++) {
                dots += "<div class='dot'></div>"; // Create a dot element for each result
            }

            // Update the content of the div with the result and re-enable the button
            document.getElementById("dieResult").innerHTML = "<div class='die-face'>" + dots + "</div>";
            document.getElementById("roll").disabled = false;
            speakResult(result);
        }, 1000); // Delay execution for 1 second to allow animation to complete
    }



    function speakResult(result) {
        // Define text to be spoken in Polish
        var textToSpeak = result;

        // Create a new SpeechSynthesisUtterance object with the text
        var utterance = new SpeechSynthesisUtterance(textToSpeak);

        // Set language to Polish
        utterance.lang = "pl-PL";

        // Speak the text
        speechSynthesis.speak(utterance);
    }

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
                url: 'server2.php', // URL of the PHP script
                type: 'GET',
                dataType: 'json',
                success: function (response) {

                    // Update UI with received data
                    $('#data-container').empty(); // Clear previous data
                    response.data.data1.forEach(function (item) {
                        if (myNick == item.nick) {
                            if (item.status == 1) {
                                $('#data-container').append('<div class="ready">' + item.nick + '⬅TY</div>');
                            }
                            else {
                                $('#data-container').append('<div class="notready">' + item.nick + '⬅TY</div>');
                            }
                        }
                        else {
                            if (item.status == 1) {
                                $('#data-container').append('<div class="ready">' + item.nick + '</div>');
                            }
                            else {
                                $('#data-container').append('<div class="notready">' + item.nick + '</div>');
                            }
                        }
                    });
                    console.error("mmm");
                    console.error(response.data);

                    var buttons = document.querySelectorAll('.buttony');
                    // Remove each button
                    buttons.forEach(function (button) {
                        button.parentNode.removeChild(button);
                    });
                    var buttons = document.querySelectorAll('.buttonr');
                    // Remove each button
                    buttons.forEach(function (button) {
                        button.parentNode.removeChild(button);
                    });
                    var buttons = document.querySelectorAll('.buttonb');
                    // Remove each button
                    buttons.forEach(function (button) {
                        button.parentNode.removeChild(button);
                    });
                    var buttons = document.querySelectorAll('.buttong');
                    // Remove each button
                    buttons.forEach(function (button) {
                        button.parentNode.removeChild(button);
                    });

                    function createAndAppendButton(containerId, className, idName) {
                        var container = document.getElementById(containerId);
                        var button = document.createElement('div');
                        button.setAttribute("id", idName);
                        button.setAttribute("onclick", "move('" + idName + "')");
                        button.classList.add(className);
                        container.appendChild(button);

                    }

                    // Create and append buttons for player 1b
                    createAndAppendButton(response.data.data2[0].player1b1, 'buttonb', "player1b1");
                    createAndAppendButton(response.data.data2[0].player1b2, 'buttonb', "player1b2");
                    createAndAppendButton(response.data.data2[0].player1b3, 'buttonb', "player1b3");
                    createAndAppendButton(response.data.data2[0].player1b4, 'buttonb', "player1b4");

                    // Create and append buttons for player 1y
                    createAndAppendButton(response.data.data2[0].player4y1, 'buttony', "player4y1");
                    createAndAppendButton(response.data.data2[0].player4y2, 'buttony', "player4y2");
                    createAndAppendButton(response.data.data2[0].player4y3, 'buttony', "player4y3");
                    createAndAppendButton(response.data.data2[0].player4y4, 'buttony', "player4y4");

                    // Create and append buttons for player 1g
                    createAndAppendButton(response.data.data2[0].player3g1, 'buttong', "player3g1");
                    createAndAppendButton(response.data.data2[0].player3g2, 'buttong', "player3g2");
                    createAndAppendButton(response.data.data2[0].player3g3, 'buttong', "player3g3");
                    createAndAppendButton(response.data.data2[0].player3g4, 'buttong', "player3g4");

                    // Create and append buttons for player 1r
                    createAndAppendButton(response.data.data2[0].player2r1, 'buttonr', "player2r1");
                    createAndAppendButton(response.data.data2[0].player2r2, 'buttonr', "player2r2");
                    createAndAppendButton(response.data.data2[0].player2r3, 'buttonr', "player2r3");
                    createAndAppendButton(response.data.data2[0].player2r4, 'buttonr', "player2r4");
                    document.getElementById("p1").innerHTML = response.data.data2[0].player1b;
                    document.getElementById("p2").innerHTML = response.data.data2[0].player2r;
                    document.getElementById("p3").innerHTML = response.data.data2[0].player3g;
                    document.getElementById("p4").innerHTML = response.data.data2[0].player4y;
                    var kolor;
                    if (response.data.data2[0].player1b == myNick) {
                        twojaTura = 1
                    } else if (response.data.data2[0].player2r == myNick) {
                        twojaTura = 2
                    } else if (response.data.data2[0].player3g == myNick) {
                        twojaTura = 3
                    } else if (response.data.data2[0].player4y == myNick) {
                        twojaTura = 4
                    }


                    tura = response.data.data2[0].tura;



                    if (response.data.data2[0].tura == twojaTura) {
                        document.getElementById("yourTurn").innerHTML = "twoja tura";
                        document.getElementById("roll").disabled = false;
                        console.log("sekundy" + seconds)
                        if (isRunning == false) {
                            seconds = 20;
                            startTimer();
                        }

                        if (seconds <= 0) {
                            isRunning = false
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "update_turn.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                    // Response from the server
                                    console.log(xhr.responseText);
                                }
                            };
                            xhr.send();


                        }


                    } else {
                        isRunning = false
                        seconds = 20;
                        document.getElementById("yourTurn").innerHTML = "";
                        document.getElementById("roll").disabled = true;
                    }


                    if (response.data.data2[0].tura == 1) {
                        document.getElementById("p1").style.backgroundColor = "lightgray";
                        document.getElementById("p2").style.backgroundColor = "white";
                        document.getElementById("p3").style.backgroundColor = "white";
                        document.getElementById("p4").style.backgroundColor = "white";
                    } else if (response.data.data2[0].tura == 2) {
                        document.getElementById("p1").style.backgroundColor = "white";
                        document.getElementById("p2").style.backgroundColor = "lightgray";
                        document.getElementById("p3").style.backgroundColor = "white";
                        document.getElementById("p4").style.backgroundColor = "white";
                    } else if (response.data.data2[0].tura == 3) {
                        document.getElementById("p1").style.backgroundColor = "white";
                        document.getElementById("p2").style.backgroundColor = "white";
                        document.getElementById("p3").style.backgroundColor = "lightgray";
                        document.getElementById("p4").style.backgroundColor = "white";
                    }
                    else if (response.data.data2[0].tura == 4) {
                        document.getElementById("p1").style.backgroundColor = "white";
                        document.getElementById("p2").style.backgroundColor = "white";
                        document.getElementById("p3").style.backgroundColor = "white";
                        document.getElementById("p4").style.backgroundColor = "lightgray";

                    }
                    if (response.data.data2[0].player1b == "X") {
                        pustaTura1 = 1;
                    } else if (response.data.data2[0].player2r == "X") {
                        if (pustaTura1 == 0) {
                            pustaTura1 = 2;
                        }
                        else {
                            pustaTura2 = 2
                        }

                    } else if (response.data.data2[0].player3g == "X") {
                        if (pustaTura1 == 0) {
                            pustaTura1 = 3;
                        }
                        else {
                            pustaTura2 = 3
                        }

                    } else if (response.data.data2[0].player4y == "X") {
                        if (pustaTura1 == 0) {
                            pustaTura1 = 4;
                        }
                        else {
                            pustaTura2 = 4
                        }

                    }

                    console.log("tura" + tura + "pusta tura1 " + pustaTura1 + "pusta tura2 " + pustaTura2)
                    if (tura == pustaTura1 || tura == pustaTura2) {
                        console.log("siuu")
                    }
                    document.getElementById("kogoTura").innerHTML = "TURA: " + response.data.data2[0].tura;

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Fetch data initially when the page loads
        fetchData();


        setInterval(fetchData, 2000);
    });


</script>

</html>