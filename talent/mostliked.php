<?php
    include "restrict/validate_login.php";
    include "../app/conection.php";
    $usuario = $_SESSION['usuario'];
    $user_id = $_SESSION['usuario_id'];
    require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <h2 class="text-uppercase especialpadd">VÍDEOS MAIS CURTIDOS</h2>

        <?php
            $sql = "SELECT * FROM videos WHERE likes > 0 ORDER BY likes DESC";
            $res = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($res) > 0){
                while($video = mysqli_fetch_assoc($res)) {
                    $video_likes = $video['likes'];
                    $usuarioid = $_SESSION['usuario_id'];
                    $videoid = $video['id'];
                    $q=mysqli_query($conexao, "SELECT id FROM likes WHERE usuario_id='$usuarioid' and video_id='$videoid'");
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
                    <input type="hidden" value="mostliked" name="headerlocal">
                    <button class="<?=$class?>" name="like-video" type="submit"><i class="<?=$iclass?>"></i></button>
                </h3>
            </form>
        </div>
    </div>
        <?php } } else { ?>

                        <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
                            <h3 class="text-center unknowpadd">Estamos trabalhando nisso.</h3>
                        </div>

    <?php } ?>
        
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