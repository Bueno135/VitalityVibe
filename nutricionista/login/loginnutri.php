<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Adiciona um echo para verificar se os dados estão sendo recebidos
    // echo "Email: $email, Senha: $senha";
    $stmt = $conn->prepare("SELECT * FROM nutricionista WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $quantidade = $result->num_rows;

    if ($quantidade == 1) {
        $nutricionista = $result->fetch_assoc();

        // Verifica a senha usando password_verify
        if (password_verify($senha, $nutricionista['senha'])) {

            if(!isset($_SESSION)){
                session_start();
            }        
            // Senha correta, faça o login
            $_SESSION['id'] = $nutricionista['id_nutricionista']; // Defina a ID do cliente na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nutricionista['nome']; // Se 'nome' é o campo correto para o nome do cliente

            header('Location: C:/xampp/htdocs/Projeto/telanutri.php');
            exit();
        } else {
            // Senha incorreta
            $erro = 'Erro de login: Senha incorreta';
        }
    } else {
        $erro = "<div class='message'>
=======
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $result = mysqli_query($conn, "SELECT * FROM nutricionista WHERE email='$email' AND senha='$senha'");

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $row['nome'];
        echo'login bem sucedido';
        header('Location: /Projeto/tela.php');
        exit();
    } else {
        echo "<div class='message'>
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
        <p>Email ou senha incorretas</p>
        </div> <BR>";
        echo "<a href='entrarnutri.php'>Voltar</a>";
    }
}
<<<<<<< HEAD


=======
?>
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
