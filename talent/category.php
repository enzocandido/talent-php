<?php
    include "../app/conection.php";
    session_start();
    $customCategory = mysqli_real_escape_string($conexao, $_GET['customCategory']);
    require_once "restrict/navbar.php";
    $usuarioid = $_SESSION['usuario_id'];
?>

<div class="container">
    <div class="container2">
        <h2 class="text-uppercase especialpadd">
            <?=$customCategory?>
        </h2>

        <?php
            $sql = "SELECT * FROM videos WHERE categoria = '$customCategory' ORDER BY id DESC ";
            $res = mysqli_query($conexao, $sql);
            if(mysqli_num_rows($res) > 0){
                while($video = mysqli_fetch_assoc($res)) {
                    $video_likes = $video['likes'];
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

            <?php
                if(isset($_SESSION['adm'])){   
            ?>

                <form method="POST" action="restrict/admin.php"><button type="submit" name="deletar-video" class="btn btn-outline-light btn-md"><i class="fas fa-trash"></i></button>
                    <input type="hidden" value="<?=$video['usuario']?>" name="usuarioNome">
                    <input type="hidden" value="<?=$video['id']?>" name="videoId">
                    <input type="hidden" value="<?=$video['titulo']?>" name="videoTitulo">
                </form>

            <?php } ?>

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
                <div class="video-data userPosted video-data-color">
                    <form method="GET" action="user"><p>Usuário: </p><button type="submit" class="btn btn-outline-light btn-md">@<?=$video['usuario']?></button>
                        <input type="hidden" value="<?=$video['usuario']?>" name="userProfile"><br>
                    </form>
                </div>
                <div class="video-data">
                    <p> 
                        Postado em <?=$video['dia_upload']?>
                    </p>
                    </div>
                </div>
                <form method="POST" action="restrict/like.php">
                    <h3 class="video-data like-button">
                        <input type="hidden" value="<?=$video['id']?>" name="postid">
                        <input type="hidden" value="category?customCategory=<?=$customCategory?>" name="headerlocal">
                        <button class="<?=$class?>" name="like-video" type="submit"><i class="<?=$iclass?>"></i></button>
                    </h3>
                </form>
            </div>

            <?php 
                }

            } else { ?>

                <div class="shadow-none p-3 mb-5 bg-custom rounded ">
                    <h3 class="text-center especialpadd unknowpadd">Sem vídeos.</h3>
                </div>
                    
            <?php 
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

</body>
</html>