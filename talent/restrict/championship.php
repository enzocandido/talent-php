<?php
    include "../../app/conection.php";
    include "restrict.php";

    if(isset($_POST['criar-campeonato'])) {
        $usuario = $_SESSION['usuario'];
        $nome = $_POST['nomeCampeonato'];
        $descricao = $_POST['descricaoCampeonato'];
        $categoria = $_POST['categoriaCampeonato'];
        $limite = $_POST['limiteCampeonato'];
        $recompensa= $_POST['recompensaCampeonato'];
        $premio = $_POST['premioCampeonato'];
        $taxaInscricao = $_POST['taxaInscricaoCampeonato'];
        $nomeUnicoCampeonato = $_POST['nomeUnicoCampeonato'];
        $dataTermino = $_POST['data_termino'];
        
        $total = $taxaInscricao * $limite;
        $lucro = $total - $recompensa;
    
        if($sql = "INSERT INTO campeonato(nome_campeonato, descricao_campeonato, categoria_campeonato, limite_usuarios, recompensa, premio, taxa_inscricao, admin_organizador, lucro, nome_unico, data_termino) VALUES('$nome', '$descricao', '$categoria',  '$limite', '$recompensa', '$premio', '$taxaInscricao', '$usuario', '$lucro', '$nomeUnicoCampeonato', '$dataTermino')"){
            $sql2 = "CREATE TABLE `$nomeUnicoCampeonato` (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                usuario_inscricao VARCHAR(30) NOT NULL,
                tipo_inscricao VARCHAR(30) NOT NULL
                )";
            mysqli_query($conexao, $sql);
            mysqli_query($conexao, $sql2);
            $_SESSION['campeonato_sucesso'] = true;
            header("Location: admin.php");
        } else {
            $_SESSION['campeonato_erro'] = true;
        }
    } else {
        header("Location: admin.php");
    }