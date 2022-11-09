<?php
    include "../../app/conection.php";
    session_start();

    if(isset($_POST['like-video'])){
        $post_id = $_POST['postid'];
        $headerlocal = $_POST['headerlocal'];
        $user_id = $_SESSION['usuario_id'];
        $liked = "lik";
        $desliked = "des";
        $sql = "SELECT `userid`, `postid` FROM `likes` WHERE userid = '$user_id' and postid = '$post_id'";
        $res = $conexao->query($sql);
        if($res->num_rows == 0){
            $sql2 = "UPDATE `videos` SET `likes`=likes+1 WHERE id='$post_id'";
            if($conexao->query($sql2)){
                $sql3="INSERT INTO `likes`(`userid`, `postid`) VALUES ('$user_id','$post_id')";
                $conexao->query($sql3);
                header("Location: ../$headerlocal");
            }
        } else if($res->num_rows ==1){
            $sql2 = "UPDATE `videos` SET `likes`=likes-1 WHERE id='$post_id'";
            if($conexao->query($sql2)){
                $sql3="DELETE FROM `likes` WHERE userid = '$user_id' and postid = '$post_id'";
                $conexao->query($sql3);
                header("Location: ../$headerlocal");
            }
        }
    }
?>