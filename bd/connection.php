<<<<<<< HEAD
<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "vitalityvibe";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

=======

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
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
