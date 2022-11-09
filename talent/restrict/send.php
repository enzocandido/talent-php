<?php
include "../../app/conection.php";
include "validate_login.php";

if(isset($_POST['submit']) && isset($_POST['my_video'])) {
    $usuario = $_SESSION['usuario'];
    $video_url = $_POST['my_video'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tags = $_POST['tags'];
    $share_url = 'youtu.be';
    $data_upload = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
    $diaUpload = $data_upload -> format('d/m/Y');

    $pos = strpos($video_url, $share_url);
    
    if ($pos === false) {
       $video_urlCONVERTED = str_replace("watch?v=", "embed/", $video_url);
       $sql = "INSERT INTO videos(usuario, video_url, titulo, descricao, categoria, tags, data_upload, dia_upload) VALUES('$usuario', '$video_urlCONVERTED', '$titulo',  '$descricao', '$categoria', '$tags', NOW(), '$diaUpload')";
        mysqli_query($conexao, $sql);
        header("Location: ../index");
    } else {
        $video_urlCONVERTED = str_replace("youtu.be/", "youtube.com/embed/", $video_url);
        $sql = "INSERT INTO videos(usuario, video_url, titulo, descricao, categoria, tags, data_upload, dia_upload) VALUES('$usuario', '$video_urlCONVERTED', '$titulo',  '$descricao', '$categoria', '$tags', NOW(), '$diaUpload')";
        mysqli_query($conexao, $sql);
        header("Location: ../index");
    }
}else{
    header("Location: ../index");
}