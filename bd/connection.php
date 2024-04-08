
<?php
    $servername = "localhost:3307";
    $username = "vb";
    $password = "1234";
    $dbname = "vitalityvibe";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    echo "Conexão ok";
?>