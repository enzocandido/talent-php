<?php
    include "../../../app/conection.php";
    include "../validate_login.php";
    include "../restrict.php";

    if(isset($_POST['submit'])){
        $usuario = $_SESSION['usuario'];
        $usuarioPunicao = $_POST['usuarioPunicao'];
        $idVideoPunicao = $_POST['idVideoPunicao'];
        $tituloVideoPunicao = $_POST['tituloVideoPunicao'];
        $motivoExclusao = $_POST['motivoVideoPunicao'];
        
        if($sql2 = "INSERT INTO adm(usuario_punido, adm_acao, videoid, motivo_exclusao, titulo_video) VALUES('$usuarioPunicao', '$usuario', '$idVideoPunicao', '$motivoExclusao' ,'$tituloVideoPunicao')"){
            $sql = "DELETE FROM videos WHERE id = '$idVideoPunicao'";
            mysqli_query($conexao, $sql);
            mysqli_query($conexao, $sql2);
            $_SESSION['sucesso_exclusao'] = true;
            header("Location: ../admin.php");
        } else {
            $_SESSION['erro_exclusao'] = true;
            header("Location: ../admin.php");
        }
    } else {
        $_SESSION['erro_exclusao'] = true;
        header("Location: ../admin.php");
    }