<?php
    include "restrict/validate_login.php";
    include "../app/conection.php";
    $usuario = $_SESSION['usuario'];
    require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <?php
            $query = "SELECT nome, usuario, biografia, adm, imagem_perfil from usuario where usuario = '$usuario'";
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
                <h1 class="text-left especialpadd2 position-relative col">
                    <?=$customName['nome']?><?php if($admBD == 1) { ?> <i class="fas fa-user-check"></i><?php } ?>
                    <p class="especialpadd position-relative col-5">@<?=$customName['usuario']?> </p>
                </h1>
                <p class="especialpadd position-relative col-5"></p>
                <div class="especialpadd position-relative col-sm">
                    <img class ="float-right profile-image border border-2" src="assets/users/profile/<?=$customName['imagem_perfil']?>" class="rounded float-right p-2 position-relative" width="300px" height="300px"></img>
                    <div class="text-center custom-space2">
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#telaFotoPerfil"><i class="fas fa-camera"></i></button>
                    </div>
                </div>
                <p class="text-left biography2">
                    <?=$customName['biografia']?>
                </p>
                <div class="biography">
                    <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#telaBiografia">Editar Perfil</button>
                </div>
            </div>
        </div>

        <?php
            $biografia = $customName['biografia'];
            $nome = $customName['nome'];
                }
            } else { 
        ?>
            <h3 class="text-center text-black especialpadd">Erro ao carregar perfil.</h3>
        <?php } ?>
        
    </div>

        <h4 class="text-center especialpadd3">
            SEUS VÍDEOS
        </h4>

        <?php
            $usuario_id = $_SESSION['usuario_id'];
            
            $sql = "SELECT * FROM videos WHERE usuario_id = $usuario_id ORDER BY id DESC";
            $res = mysqli_query($conexao, $sql);
            
            if (!$res) {
                echo '<div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">';
                echo '<h3 class="text-center">Erro ao buscar vídeos: ' . mysqli_error($conexao) . '</h3>';
                echo '</div>';
            } 
            elseif(mysqli_num_rows($res) > 0){
                while($video = mysqli_fetch_assoc($res)) {
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
                    Postado em <?=date('d/m/Y', strtotime($video['data_upload']))?>
                </p>
            </div>
            <h3 class="video-data like-button">
                <button class="btn btn-danger btn-lg" name="like-video" type="submit"><i class="fas fa-heart"></i> <?=$video['likes']?></button>
            </h3>

    <?php
                }
            } else { 
    ?>

    <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
        <h3 class="text-center">Você ainda não postou vídeos.</h3>
    </div>

    <?php       } ?>

        </div>
    </div>

<div class="modal fade" id="telaBiografia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-black" id="exampleModalLabel">Atualizar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <?php
                    if(isset($_SESSION['profileupdate_error'])):
                ?>
    
                <script type="text/javascript">
                    $(window).on('load',function(){
                    $('#telaBiografia').modal('show');});
                </script>

                <div class="alert alert-danger" role="alert">
                    ERRO! Verifique suas informações e tente novamente.
                </div>

                <?php
                    endif;
                    unset($_SESSION['profileupdate_error']);
                ?>

                <form method="POST" action="restrict/updateProfile.php">
                    <div class="mb-3 text-center">
                        <img src="assets/users/profile/<?=$_SESSION['imagem_perfil']?>" alt="Imagem de Perfil" width="100px" class="rounded-circle border border-custom">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Novo nome</label>
                        <input type="text" name="newName" value="<?=$nome?>" required="required" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nova biografia</label>
                        <input type="text" name="newBio" value="<?=$biografia?>" required="required" class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-black">Atualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="telaFotoPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="exampleModalLabel">Atualizar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php
                    if(isset($_SESSION['profileimgupdate_error'])):
                ?>
        
                <script type="text/javascript">
                    $(window).on('load',function(){
                    $('#telaFotoPerfil').modal('show');});
                </script>

                <div class="alert alert-danger" role="alert">
                    ERRO! Verifique sua imagem.
                </div>

                <?php
                    endif;
                    unset($_SESSION['profileimgupdate_error']);
                    if(isset($_SESSION['profileimgupdate_success'])):
                ?>
    
                <script type="text/javascript">
                    $(window).on('load',function(){
                    $('#telaFotoPerfil').modal('show');});
                </script>

                <div class="alert alert-success" role="alert">
                    Sucesso ao atualizar imagem de perfil.
                </div>

                <?php
                    endif;
                    unset($_SESSION['profileimgupdate_success']);
                ?>

                <form method="POST" action="restrict/updateProfileImg.php" enctype="multipart/form-data">
                    <div class="form-group text-center custom-space3">
                        <img src="assets/users/profile/<?=$_SESSION['imagem_perfil']?>" onclick="triggerClick()" id="profileDisplay" name="profileDisplay" width="200px" class="rounded-circle">
                        <label for="profileImage" class="text-black labelimg">Foto de Perfil</label>
                        <label for="profileImage" class="text-black labelimg">Tamanho Max: 8mb.<br>Tipos de Arquivos Suportados: JPEG, JPG, PNG e GIF</label>
                        <input type="file" name="profileImage" onchange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                    </div>
                    
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-black" name="save-user-img">Atualizar</button>
                    </div>
                </form>
                
            </div>
        </div>
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