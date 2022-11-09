<?php
    include "../app/conection.php";
    include "restrict/validate_login.php";
    require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <h1 class="text-left especialpadd">Categorias disponíveis:</h1>
        <div class="shadow-none p-3 mb-5 rounded ">
            <div class="unknowpadd2">
                <div class="row especialpadd text-center">

                <?php
                $sql = ("SELECT DISTINCT categoria FROM videos");
                $res = mysqli_query($conexao, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($video = mysqli_fetch_assoc($res)) { ?>

                <div class="col">
                    <form method="GET" action="category"><button type="submit" class="btn btn-light btn-lg text-uppercase"><?=$video['categoria']?>
                    </button>
                        <input type="hidden" value="<?=$video['categoria']?>" name="customCategory"><br>
                    </form>
                </div>
    
                <?php } }else { ?>
                <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
                <h3 class="text-center">Ainda não temos categorias.</h3>
                </div>
                
                <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once "restrict/footer.php";
?>

</body>
</html>