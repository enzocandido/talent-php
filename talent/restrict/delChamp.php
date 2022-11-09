<?php 
    include "../../app/conection.php";
    session_start();

    $nomeUnicoCampeonato = mysqli_real_escape_string($conexao, $_POST['nomeUnicoChamp']);
    $idChamp = mysqli_real_escape_string($conexao, $_POST['idChamp']);

    if($sql = "DELETE FROM campeonato WHERE id = '$idChamp'"){
        mysqli_query($conexao, $sql);
        $sql2 = "DROP TABLE `$nomeUnicoCampeonato`";
        mysqli_query($conexao, $sql2);
        $_SESSION['exclusao_sucesso'] = true;
        header("Location: ../championships.php");
    } else {
        $_SESSION['exclusao_erro'] = true;
        header("Location: ../championships.php");
    }
?>