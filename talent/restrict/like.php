<?php
    include "../../app/conection.php";
    session_start();

    if(isset($_POST['like-video'])){
        $video_id = $_POST['postid'];
        $headerlocal = $_POST['headerlocal'];
        $usuario_id = $_SESSION['usuario_id'];
        
        $sql = "SELECT `usuario_id`, `video_id` FROM `likes` WHERE usuario_id = '$usuario_id' AND video_id = '$video_id'";
        $res = $conexao->query($sql);
        
        if (!$res) {
            $_SESSION['like_error'] = "Erro ao verificar like: " . mysqli_error($conexao);
            header("Location: ../$headerlocal");
            exit();
        }
        
        if($res->num_rows == 0){
            $sql2 = "UPDATE `videos` SET `likes`= likes + 1 WHERE id = '$video_id'";
            if($conexao->query($sql2)){
                $sql3 = "INSERT INTO `likes`(`usuario_id`, `video_id`) VALUES ('$usuario_id', '$video_id')";
                if ($conexao->query($sql3)) {
                    header("Location: ../$headerlocal");
                    exit();
                } else {
                    $_SESSION['like_error'] = "Erro ao registrar like: " . mysqli_error($conexao);
                    header("Location: ../$headerlocal");
                    exit();
                }
            } else {
                $_SESSION['like_error'] = "Erro ao atualizar contador de likes: " . mysqli_error($conexao);
                header("Location: ../$headerlocal");
                exit();
            }
        } 
        else if($res->num_rows == 1){
            $sql2 = "UPDATE `videos` SET `likes`= likes - 1 WHERE id = '$video_id'";
            if($conexao->query($sql2)){
                $sql3 = "DELETE FROM `likes` WHERE usuario_id = '$usuario_id' AND video_id = '$video_id'";
                if ($conexao->query($sql3)) {
                    header("Location: ../$headerlocal");
                    exit();
                } else {
                    $_SESSION['like_error'] = "Erro ao remover like: " . mysqli_error($conexao);
                    header("Location: ../$headerlocal");
                    exit();
                }
            } else {
                $_SESSION['like_error'] = "Erro ao atualizar contador de likes: " . mysqli_error($conexao);
                header("Location: ../$headerlocal");
                exit();
            }
        }
    } else {
        header("Location: ../index");
        exit();
    }
?>