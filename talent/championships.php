<?php
include "../app/conection.php";
include "restrict/validate_login.php";
require_once "restrict/navbar.php";
?>

<div class="container">
    <div class="container2">
        <?php
            if(isset($_SESSION['inscricao_sucesso'])):
        ?>
                <div class="alert alert-success" role="alert">
                    Inscrito com sucesso.
                </div>
        <?php
            endif;
            unset($_SESSION['inscricao_sucesso']);
        ?>

        <?php
            if(isset($_SESSION['inscricao_erro'])):
        ?>
                <div class="alert alert-danger" role="alert">
                    Erro ao inscrever-se.
                </div>
        <?php
            endif;
            unset($_SESSION['inscricao_erro']);
        ?>

        <?php
            if(isset($_SESSION['desinscricao_sucesso'])):
        ?>
                <div class="alert alert-success" role="alert">
                    Sucesso ao remover inscrição.
                </div>
        <?php
            endif;
            unset($_SESSION['desinscricao_sucesso']);
        ?>

        <?php
            if(isset($_SESSION['desinscricao_erro'])):
        ?>
                <div class="alert alert-danger" role="alert">
                    Erro ao remover inscrição.
                </div>
        <?php
            endif;
            unset($_SESSION['desinscricao_erro']);
        ?>

        <?php
            if(isset($_SESSION['exclusao_sucesso'])):
        ?>
                <div class="alert alert-success" role="alert">
                    Sucesso ao excluir campeonato.
                </div>
        <?php
            endif;
            unset($_SESSION['exclusao_sucesso']);
        ?>

        <?php
            if(isset($_SESSION['exclusao_erro'])):
        ?>
                <div class="alert alert-danger" role="alert">
                    Erro ao excluir campeonato.
                </div>
        <?php
            endif;
            unset($_SESSION['exclusao_erro']);
        ?>

        <?php
            $usuario = $_SESSION['usuario'];
            $query = "SELECT * from campeonato ORDER by ID desc";
            $res = mysqli_query($conexao, $query);
        
            if(mysqli_num_rows($res) > 0){
                while($campeonato = mysqli_fetch_assoc($res)) {
                    $taxaCampeonato = $campeonato['taxa_inscricao'];
                    $nomeUnicoCampeonato = $campeonato['nome_unico'];
        ?>
                
                    <div class="shadow-none p-3 mb-5 bg-custom rounded">

                        <?php
                            if(isset($_SESSION['adm'])){   
                        ?>

                        <form method="POST" action="restrict/delChamp.php"><button onclick="return confirm('Tem certeza que deseja excluir esse campeonato?')" name="deletar-video" class="btn btn-outline-light btn-md"><i class="fas fa-trash"></i></button>
                            <input type="hidden" value="<?=$campeonato['id']?>" name="idChamp">
                            <input type="hidden" value="<?=$campeonato['nome_unico']?>" name="nomeUnicoChamp">
                        </form>

                        <?php } ?>

                        <h2 class="text-center userSpace3">
                            <?=$campeonato['nome_campeonato']?>
                        </h2>
                        <p class="video-data2 video-data biography2 log">
                            <?=$campeonato['descricao_campeonato']?>
                        </p>
                        <h2 class="video-data2 video-data">
                            Categoria do Campeonato: <?=$campeonato['categoria_campeonato']?>
                        </h2>
                        <h2 class="video-data2 video-data">
                            Recompensa em dinheiro: R$<?=$campeonato['recompensa']?>
                        </h2>
                        <h2 class="video-data2 video-data">
                            Prêmio: <?=$campeonato['premio']?>
                        </h2>
                        <h2 class="video-data2 video-data userSpace2">
                            Taxa de inscrição: R$<?=$campeonato['taxa_inscricao']?>
                        </h2>

                <?php 
                $sql = "SELECT * from ".$nomeUnicoCampeonato." ORDER BY id DESC";
                $result_query = mysqli_query($conexao, $sql);
                $inscricao = mysqli_fetch_assoc($result_query);

                if(mysqli_num_rows($result_query) > 0){ 
                    if($inscricao['usuario_inscricao'] != $usuario){
                ?>

                        <div class="text-center especialpadd">
                            <form method="GET" action="champ"><button type="submit" class="btn btn-outline-light btn-lg">Vídeos Participantes</button>
                                <input type="hidden" value="<?=$campeonato['nome_campeonato']?>" name="customChamp"><br>
                                <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato"><br>
                            </form>
                        </div>
                        <div class="text-end log">
                            <p>Contate o suporte para efetuar pagamento da taxa de inscrição:</p>
                            <a href="https://www.facebook.com/Plataforma-Talent-Brasil-101804075572449/" target = "_blank">Facebook</a><br>
                            <a href="https://www.instagram.com/plataforma.talent/" target = "_blank">Instagram</a><br>
                            <a href="https://twitter.com/TalentBrazil" target = "_blank">Twitter</a><br>
                            <a href="https://www.youtube.com/channel/UCII_fQ_xWjyCW6GsKfNpd0A">YouTube</a>
                        </div>
                        <form method="POST" action="restrict/registerCamp.php">
                            <input type="hidden" value="<?=$usuario?>" name="usuarioInscrever">
                            <input type="hidden" value="<?=$taxaCampeonato?>" name="taxaCampeonatoInscrever">
                            <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato">
                            <div class="text-end"> 
                                <button type="submit" name="inscrever_campeonato" class="btn btn-outline-light">Inscrever-se</button>
                            </div>
                        </form>

                <?php } else {

                    if($inscricao['tipo_inscricao'] == 1){ ?>

                        <div class="text-center especialpadd">
                            <form method="GET" action="champ"><button type="submit" class="btn btn-outline-light btn-lg">Vídeos Participantes</button>
                                <input type="hidden" value="<?=$campeonato['nome_campeonato']?>" name="customChamp"><br>
                                <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato"><br>
                            </form>
                        </div>
                        <div class="text-end"> 
                            <form method="POST" action="restrict/cancelCamp.php">
                                <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato">
                                <button type="submit" name="cancelar-inscricao" class="btn btn-outline-danger btn-sm">Cancelar</button>
                                <button type="button" class="btn btn-outline-success disabled">Inscrito</button>
                            </form>
                        </div>

                <?php } else { ?>

                    <div class="text-center especialpadd">
                        <form method="GET" action="champ"><button type="submit" class="btn btn-outline-light btn-lg">Vídeos Participantes</button>
                            <input type="hidden" value="<?=$campeonato['nome_campeonato']?>" name="customChamp"><br>
                            <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato"><br>
                        </form>
                    </div>
                    <div class="text-end"> 
                        <form method="POST" action="restrict/cancelCamp.php">
                            <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato">
                            <button type="submit" name="cancelar-inscricao" class="btn btn-outline-danger btn-sm">Cancelar</button>
                            <button type="button" class="btn btn-outline-danger disabled">Inscrição Pendente</button>
                        </form>
                    </div>  

                <?php } } ?>

            <?php } else { ?>

                <div class="text-center especialpadd">
                    <form method="GET" action="champ"><button type="submit" class="btn btn-outline-light btn-lg">Vídeos Participantes</button>
                        <input type="hidden" value="<?=$campeonato['nome_campeonato']?>" name="customChamp"><br>
                        <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato"><br>
                    </form>
                </div>

                <form method="POST" action="restrict/registerCamp.php">
                    <input type="hidden" value="<?=$usuario?>" name="usuarioInscrever">
                    <input type="hidden" value="<?=$taxaCampeonato?>" name="taxaCampeonatoInscrever">
                    <input type="hidden" value="<?=$nomeUnicoCampeonato?>" name="nomeUnicoCampeonato">
                    <div class="text-end log">
                        <p>Contate o suporte para efetuar pagamento da taxa de inscrição:</p>
                        <a href="https://www.facebook.com/Plataforma-Talent-Brasil-101804075572449/" target = "_blank">Facebook</a><br>
                        <a href="https://www.instagram.com/plataforma.talent/" target = "_blank">Instagram</a><br>
                        <a href="https://twitter.com/TalentBrazil" target = "_blank">Twitter</a><br>
                        <a href="https://www.youtube.com/channel/UCII_fQ_xWjyCW6GsKfNpd0A">YouTube</a>
                    </div>
                    <div class="text-end"> 
                        <button type="submit" name="inscrever_campeonato" class="btn btn-outline-light">Inscrever-se</button>
                    </div>
                </form>

            <?php } ?>

            </div>
        
        <?php } } else { ?>
        
                <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
                    <h3 class="text-center unknowpadd">Sem campeonatos.</h3>
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