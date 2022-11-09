<?php
include "../../app/conection.php";
session_start();

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuarioOriginal = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim(password_hash($_POST['senha'], PASSWORD_DEFAULT)));
$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));

$usuario = strtolower($usuarioOriginal);

$sql = "select count(*) as total from usuario where usuario = '$usuario' or email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
    $_SESSION['usuario_existe'] = true;
    header('Location: ../index');
    exit;
}

$sql = "INSERT INTO usuario (nome, usuario, senha, data_cadastro, email, data_nascimento, adm, biografia, imagem_perfil) VALUES ('$nome', '$usuario', '$senha', NOW(), '$email', '$data_nascimento', '0', 'Sem biografia.', 'profileimg.png')";

if($conexao->query($sql) === TRUE){
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: ../index');
exit;

?>