<?php
include "../../app/conection.php";
include "validate_login.php";

if(isset($_POST['inscrever_campeonato'])) {
    $usuario = $_SESSION['usuario'];
    $nomeUnicoCampeonato = $_POST['nomeUnicoCampeonato'];
    $taxaInscricao = $_POST['taxaCampeonatoInscrever'];

    if(empty($taxaInscricao)){
        $taxaInscricao = 1;
    } else{
        $taxaInscricao = 0;
    }
 
    if($sql = "INSERT INTO ".$nomeUnicoCampeonato." (usuario_inscricao, tipo_inscricao) VALUES('$usuario', '$taxaInscricao')"){
        mysqli_query($conexao, $sql);
        $_SESSION['inscricao_sucesso'] = true;
        header("Location: ../championships");

    } else {
        $_SESSION['inscricao_erro'] = true;
    }
}else{
    $_SESSION['inscricao_erro'] = true;
    header("Location: ../championships");
}