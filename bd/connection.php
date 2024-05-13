
<?php
    $servernome = "localhost:3306";
    $usernome = "root";
    $password = "";
    $dbnome = "vitalityvibe";

    $conn = new mysqli($servernome, $usernome, $password, $dbnome);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    echo "Conexão ok<BR>";
?>