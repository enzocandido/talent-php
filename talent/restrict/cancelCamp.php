<?php
    include "../../app/conection.php";
    include "validate_login.php";

    if(isset($_POST['cancelar-inscricao'])) {
        $usuario = $_SESSION['usuario'];
        $nomeUnicoCampeonato = $_POST['nomeUnicoCampeonato'];
    
        if($sql = "DELETE FROM ".$nomeUnicoCampeonato." WHERE usuario_inscricao = '$usuario'"){
            mysqli_query($conexao, $sql);
            $_SESSION['desinscricao_sucesso'] = true;
            header("Location: ../championships");
        } else {
            $_SESSION['desinscricao_erro'] = true;
            header("Location: ../championships");
        }
        } else {
            $_SESSION['desinscricao_erro'] = true;
        header("Location: ../championships");
        }

    