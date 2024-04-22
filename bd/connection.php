

<?php
<<<<<<< HEAD
    $servernome = "localhost:3307";
    $usernome = "vb";
    $password = "1234";
=======
    $servernome = "localhost:3306";
    $usernome = "root";
    $password = "";
>>>>>>> 647c52fc0ca26000666443febedb459a929b272b
    $dbnome = "vitalityvibe";

    $conn = new mysqli($servernome, $usernome, $password, $dbnome);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    echo "Conexão ok<BR>";
?>
