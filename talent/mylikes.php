<?php
    include "restrict/validate_login.php";
    include "../app/conection.php";
    $usuario = $_SESSION['usuario'];
    $user_id = $_SESSION['usuario_id'];
    require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <h2 class="text-uppercase especialpadd">VÍDEOS QUE VOCÊ CURTIU</h2>
        <?php
            $sql2 = "SELECT `userid`, `postid` FROM `likes` WHERE userid = '$user_id'";
            if($res2 = $conexao->query($sql2)){
                if(mysqli_num_rows($res2) > 0){
                while($liked = mysqli_fetch_assoc($res2)){
                    $postliked = $liked['postid'];
                    $sql = "SELECT * FROM videos WHERE id= '$postliked' ORDER BY id DESC";
                    $res = mysqli_query($conexao, $sql);
                    if(mysqli_num_rows($res) > 0){
                        while($video = mysqli_fetch_assoc($res)) {
                            $video_likes = $video['likes'];
                            $usuarioid = $_SESSION['usuario_id'];
                            $videoid = $video['id'];
                            $q=mysqli_query($conexao, "SELECT id FROM likes WHERE userid='$usuarioid' and postid='$videoid'");
                            if(mysqli_num_rows($q)==0){
                                $class = "btn btn-outline-danger btn-lg";
                                $iclass = "far fa-heart";
                            } else {
                                $class = "btn btn-danger btn-lg";
                                $iclass = "fas fa-heart";
                            }
        ?>
        
        <div class="shadow-none p-3 mb-5 bg-custom rounded">
            <h3 class="text-center video-title">
                <?=$video['titulo']?>
            </h3>
        <div class="row">
            <iframe class="rounded" width="100%" height="600px" 
                src="<?=$video['video_url']?>"
                title="Player do YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
            <p class="video-data2 video-data">
                <?=$video['descricao']?>
            </p>
            <div class="video-data">
                <form method="GET" action="category.php"><p>Categoria: </p><button type="submit" class="btn btn-outline-light btn-md"><?=$video['categoria']?></button>
                    <input type="hidden" value="<?=$video['categoria']?>" name="customCategory"><br>
                </form>
            </div>
            <div class="video-data">
                <p> 
                    Postado em <?=$video['dia_upload']?>
                </p>
            </div>
            <form method="POST" action="restrict/like.php">
                        <h3 class="video-data like-button">
                            <input type="hidden" value="<?=$video['id']?>" name="postid">
                            <input type="hidden" value="mylikes" name="headerlocal">
                            <button class="<?=$class?>" name="like-video" type="submit"><i class="<?=$iclass?>"></i></button>
                        </h3>
                </form>
            </div>
        </div>
        <?php 
                        } 
                    } 
                }       
                } else { 
        ?>
                    <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
                        <h3 class="text-center unknowpadd">Você ainda não curtiu vídeos.</h3>
                    </div> 
        <?php
                }
            }
        ?>  

        </div>
    </div>

<?php
    require_once "restrict/footer.php";
?>

<a href="#" class="scroll-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="assets/js/profileScript.js"></script>

</body>
</html>