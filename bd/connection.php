
<<<<<<< HEAD
<?php
    $servernome = "localhost:3306";
=======
<<<<<<< HEAD
<?php
    $servernome = "localhost:3306";
=======

<?php
    $servernome = "localhost:3307";
>>>>>>> 6439456bd1118bc4f8cbbf7b2b8d67e612e0566b
>>>>>>> e6aaaf99ba17631a70e7047f772f62634170eebd
    $usernome = "root";
    $password = "";
    $dbnome = "vitalityvibe";

    $conn = new mysqli($servernome, $usernome, $password, $dbnome);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    echo "Conexão ok<BR>";
<<<<<<< HEAD
?>
=======
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 6439456bd1118bc4f8cbbf7b2b8d67e612e0566b
>>>>>>> e6aaaf99ba17631a70e7047f772f62634170eebd
