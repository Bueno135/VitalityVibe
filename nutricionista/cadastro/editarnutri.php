<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d
    <title>Verificar cadastro</title>
</head>
<body>
<?php
include '/xampp/htdocs/Projeto/bd/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE nutricionista SET nome=?, email=?, cpf=?, dt_nasc=?, sexo=?, cep=?, especialidade=?, formacao=? WHERE id_nutricionista=?");


    $stmt->bind_param("sssssssssi", $nome, $email, $cpf, $dt_nasc, $sexo, $cep, $especialidade, $formacao, $id_nutricionista);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $dt_nasc = $_POST['dt_nasc'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
    $especialidade = $_POST['especialidade'];
    $formacao = $_POST['formacao'];
   


    if ($stmt->execute()) {
<<<<<<< HEAD
    echo "<script>
    Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Cadastro atualizado com sucesso',
        showConfirmButton: false,
        timer: 1500
    });
    setTimeout(function() {
        window.location.href='/Projeto/login/entrarnutri.php';
    }, 1500);
    </script>";
} else {
    echo "Erro ao atualizar o cadastro: " . $conn->error;
}

=======
        echo "<script>Swal.fire({
            position: "top",
            icon: "sucess",
            title: "Cadastro atualizado com sucesso",
            showConfirmButton: false,
            timer: 1500
            });
    }; window.location.href='/Projeto/login/entrarnutri.php';</script>";
    } else {
        echo "Erro ao atualizar o cadastro: " . $conn->error;
    }
>>>>>>> efbd70cd98857f85ab17a6b9ebaed18fba0e4b9d

    $stmt->close();
    $conn->close();
}

?>
</body>
</html>