<?php
    include "../app/conection.php";
    session_start();
    $customName = mysqli_real_escape_string($conexao, $_GET['userProfile']);
    $customNameVideo = mysqli_real_escape_string($conexao, $_GET['userProfile']);
    $usuarioid = $_SESSION['usuario_id'];
    require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">

        <?php
            $query = "SELECT nome, usuario, biografia, adm, imagem_perfil from usuario where usuario = '$customName'";
            $result = mysqli_query($conexao, $query);
            if(mysqli_num_rows($result) > 0){
                while($customName = mysqli_fetch_assoc($result)) {
                    $admBD = $customName['adm'];
                    if($admBD == 1){
        ?>
            <div class="border-top border-danger rounded border-4">
        <?php } ?>

            <div class="profile-card rounded bg-custom">
                <div class="row">
                    <h2 class="text-left especialpadd2 position-relative col">
                        <?=$customName['nome']?><?php if($admBD == 1){?> <i class="fas fa-user-check"></i><?php } ?>
                        <p class="especialpadd position-relative col-5">@<?=$customName['usuario']?> </p>
                    </h2>
                    <p class="especialpadd position-relative col-5"></p>
                    <div class="especialpadd position-relative col-sm">
                        <img class ="float-right profile-image border border-2" src="assets/users/profile/<?=$customName['imagem_perfil']?>" class="rounded float-right p-2 position-relative" width="300px" height="300px"></img>
                    </div>
                    <p class="text-left biography2">
                        <?=$customName['biografia']?>
                    </p>
                    </div>                
                </div>
            </div>
            <h4 class="text-center especialpadd3">
                VÍDEOS DE @<?=$customName['usuario']?>
            </h4>
        <?php
                }
            } else { ?>
                <h3 class="text-center especialpadd">Erro ao carregar perfil.</h3>
            <?php
                } 

                $sql = "SELECT * FROM videos WHERE usuario= '$customNameVideo' ORDER BY id DESC";
                $res = mysqli_query($conexao, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($video = mysqli_fetch_assoc($res)) {
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
            <iframe width="100%" height="600px" class="rounded" 
                src="<?=$video['video_url']?>"
                title="Player do YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
            <div class="row">
                <p class="video-data2 video-data">
                    <?=$video['descricao']?>
                </p>
                <div class="video-data">
                    <form method="GET" action="category"><p>Categoria: </p><button type="submit" class="btn btn-outline-light btn-md"><?=$video['categoria']?></button>
                        <input type="hidden" value="<?=$video['categoria']?>" name="customCategory"><br>
                    </form>
                </div>
                <form method="POST" action="restrict/like.php">
                    <h3 class="video-data like-button">
                        <input type="hidden" value="<?=$video['id']?>" name="postid">
                        <input type="hidden" value="user?userProfile=<?=$customNameVideo?>" name="headerlocal">
                        <button class="<?=$class?>" name="like-video" type="submit"><i class="<?=$iclass?>"></i></button>
                    </h3>
                </form>
            </div>  
        </div>   

        <?php
                    }
            } else { 
        ?>
                <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
                    <h3 class="text-center">Esse usuário ainda não postou vídeos.</h3>
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

