<?php
include "../app/conection.php";
include "restrict/validate_login.php";
$userSearch = mysqli_real_escape_string($conexao, $_GET['userSearch']);
require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <?php
            $query = "SELECT nome, usuario, biografia, adm, imagem_perfil from usuario where usuario like '%".$userSearch."%'";
            $res = mysqli_query($conexao, $query);
            
            if(mysqli_num_rows($res) > 0){
                while($userSearch = mysqli_fetch_assoc($res)) {
                    $admBD = $userSearch['adm'];
        ?>

        <div class="userSpace">
            <?php
                if($admBD == 1){
            ?>
                    <div class="border-top border-danger rounded border-4 userSpace">
            <?php } ?>
            
            <div class="profile-card rounded bg-custom">
                <div class="row">
                    <h1 class="text-left especialpadd2 position-relative col">
                        <?=$userSearch['nome']?><?php if($admBD == 1){?><i class="fas fa-user-check"></i><?php } ?>
                        <p class="especialpadd position-relative col-5">@<?=$userSearch['usuario']?></p>
                    </h1>
                    <p class="especialpadd position-relative col-5"></p>
                    <div class="especialpadd position-relative col-sm">
                        <img class ="float-right profile-image border border-2" src="assets/users/profile/<?=$userSearch['imagem_perfil']?>" class="rounded float-right p-2 position-relative" width="300px" height="300px"></img>
                    </div>
                    <p class="text-left biography2">
                        <?=$userSearch['biografia']?>
                    </p>
                    <form method="GET" action="user">
                        <input type="hidden" value="<?=$userSearch['usuario']?>" name="userProfile"><br>
                        <div class="text-end"> 
                            <button type="submit" class="btn btn-outline-light btn-sm">Abrir Perfil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
                    }
                } else { 
        ?>

        <div class="shadow-none p-3 mb-5 bg-custom rounded ">
            <h3 class="text-center unknowpadd">Nenhum usuário com esse @ encontrado.</h3>
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
