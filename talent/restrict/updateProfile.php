<?php
    include "../../app/conection.php";
    include "validate_login.php";

    $usuario = $_SESSION['usuario'];
    $newBio = mysqli_real_escape_string($conexao, trim($_POST['newBio']));
    $newName = mysqli_real_escape_string($conexao, trim($_POST['newName']));
    $sql = "UPDATE usuario SET biografia = '$newBio', nome = '$newName' WHERE usuario = '$usuario'";

    if($conexao->query($sql) === TRUE){
        $_SESSION['nome'] = $newName;
        $_SESSION['profileupdate_success'] = true;
    }

    $conexao->close();

    header('Location: ../profile');
    
    exit;
?>