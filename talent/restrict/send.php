<?php
include "../../app/conection.php";
include "validate_login.php";

if(isset($_POST['submit']) && isset($_POST['my_video'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $video_url = $_POST['my_video'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tags = $_POST['tags'];
    $share_url = 'youtu.be';

    $pos = strpos($video_url, $share_url);
    
    if ($pos === false) {
       $video_urlCONVERTED = str_replace("watch?v=", "embed/", $video_url);
       $sql = "INSERT INTO videos(usuario_id, video_url, titulo, descricao, categoria, tags) VALUES($usuario_id, '$video_urlCONVERTED', '$titulo',  '$descricao', '$categoria', '$tags')";
       
       if (mysqli_query($conexao, $sql)) {
           header("Location: ../index");
           exit();
       } else {
           $_SESSION['upload_error'] = "Erro ao enviar vídeo: " . mysqli_error($conexao);
           header("Location: ../index");
           exit();
       }
    } else {
        $video_urlCONVERTED = str_replace("youtu.be/", "youtube.com/embed/", $video_url);
        $sql = "INSERT INTO videos(usuario_id, video_url, titulo, descricao, categoria, tags) VALUES($usuario_id, '$video_urlCONVERTED', '$titulo',  '$descricao', '$categoria', '$tags')";
        
        if (mysqli_query($conexao, $sql)) {
            header("Location: ../index");
            exit();
        } else {
            $_SESSION['upload_error'] = "Erro ao enviar vídeo: " . mysqli_error($conexao);
            header("Location: ../index");
            exit();
        }
    }
} else {
    header("Location: ../index");
    exit();
}