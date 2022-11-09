<?php
    session_start();
    include "../app/conection.php";
    include "restrict/navbar.php";
?>

<?php if(isset($_SESSION['usuario'])): ?>
    
<div class="container">
    <div class="container2">
        <h1 class="text-left especialpadd"><?php echo $saudacao;?> <?php echo $_SESSION['nome']?>, temos novidades para você!</h1>
        <div class="row especialpadd text-center">
            <div class="col">
                <form action="categories">
                    <button type="submit" class="btn btn-light btn-lg">Categorias</button>
                </form>
            </div>
            <div class="col">
                <form action="mostliked">
                    <button type="submit" class="btn btn-light btn-lg">Mais Curtidos</button>
                </form>
            </div>
            <div class="col">
                <form action="championships">
                    <button type="submit" class="btn btn-light btn-lg">Campeonatos</button>
                </form>
            </div>
            <div class="col">
                <form action="mylikes">
                    <button type="submit" class="btn btn-light btn-lg">Favoritos</button>
                </form>
            </div>
        </div>

    <?php else: ?>

        <div class="container">
            <div class="container2">
                <div class="row">
                    <p class="especialpadd text-danger">Faça login ou cadastre-se para utilizar as funcionalidades do site!</p>
                    <h2 class="especialpadd">Olá visitante, primeira vez aqui no TALENT? Vamos nos conhecer melhor!</h2>
                    <div class="col-md-5 especialpadd">
                        <h4>O que é TALENT?</h4>
                        <p class="especialpadd">TALENT é um novo lugar onde você pode divulgar seus talentos e ver o talento de outras pessoas(alguns exemplos podem ser encontrados logo abaixo).</p>
                        <h4>Por que usar o TALENT?</h4>
                        <p class="especialpadd">Usando o TALENT, além de você ter um espaço único para poder divulgar aquilo que mais gosta de fazer, você contará com uma página para um perfil só seu, pode ver o perfil de outras pessoas, curtir publicações e muito mais! Venha conferir!</p>
                        <h4>Qual o diferencial do TALENT?</h4>
                        <p>Somente no TALENT você será visto pelo seu talento e ainda pode concorrer a campeonatos valendo prêmios. Aqui seu talento vale ouro! Tem problemas com autoestima? Sem problemas! Também temos opções para postagem anônimas!</p>
                    </div>
                    <img class="col-md-7 especialpadd" src="assets/img/logo/laptop.png" alt="Laptop TALENT">
                </div>
                    <div class="text-center btn-lg">
                        <button type="button" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#telaCadastro">Começar</button>
                        <a href="about" class="btn btn-light btn-lg">Sobre Nós</a>
                    </div>
                <h3 class="custom-space">Se interessou pela plataforma? Confira alguns talentos abaixo, você irá amar!</h3>

    <?php endif; ?>
        
                <div class="results"></div>
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

<script src="assets/js/videoscript.js" type="text/javascript"></script>

</body>
</html>