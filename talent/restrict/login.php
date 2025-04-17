<?php
    session_start();
    include "../../app/conection.php";

    if(empty($_POST['usuario']) || empty($_POST['senha'])){
        header('Location: ../index');
        exit();
    }

    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $password =  mysqli_real_escape_string($conexao, $_POST['senha']);
    $sql = $conexao->query("SELECT usuario_id, nome, usuario, adm, imagem_perfil, senha from usuario where usuario = '{$usuario}'");

    if($sql->num_rows > 0){
        $usuario_bd = $sql->fetch_array();

            if(password_verify($password, $usuario_bd['senha'])){
                $admin = "SELECT adm from usuario where usuario = '{$usuario}' and adm = 1";
                $adm = mysqli_query($conexao, $admin);

                if(mysqli_num_rows($adm) == 1){
                    $_SESSION['adm'] = $usuario;
                    $_SESSION['id'] = $usuario_bd['usuario_id'];
                    $_SESSION['usuario']= $usuario;
                    $_SESSION['imagem_perfil'] = $usuario_bd['imagem_perfil'];
                    $_SESSION['usuario_id'] = $usuario_bd['usuario_id'];
                    $_SESSION['nome'] = $usuario_bd['nome'];
                    unset($_SESSION['nao_autenticado']);
                    header('Location: admin.php');
                    exit();
                } else {
                    $_SESSION['usuario']= $usuario;
                    $_SESSION['id'] = $usuario_bd['usuario_id'];
                    $_SESSION['imagem_perfil'] = $usuario_bd['imagem_perfil'];
                    $_SESSION['usuario_id'] = $usuario_bd['usuario_id'];
                    $_SESSION['nome'] = $usuario_bd['nome'];
                    unset($_SESSION['nao_autenticado']);
                    header('Location: ../index');
                    exit();
                }

            } else {
            if(isset($_SESSION['nao_autenticado'])){
                $_SESSION['nao_autenticado']++;
            } else {
                $_SESSION['nao_autenticado'] = 0;
            }
            header('Location: ../index');
            exit();
            }

    } else {
        if(isset($_SESSION['nao_autenticado'])){
            $_SESSION['nao_autenticado']++;
        } else {
            $_SESSION['nao_autenticado'] = 0;
        }

        header('Location: ../index');
        exit();
    }
