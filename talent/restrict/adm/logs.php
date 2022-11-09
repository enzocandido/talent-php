<?php
    include "../../../app/conection.php";
    include "../restrict.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="../../assets/css/animate.css" />
    <link rel="stylesheet" href="../../assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="../../assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <script src="../../assets/js/wow.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/6b06435efd.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
    <title>TALENT</title>
</head>

<body>

<header class="bg-custom fixed-top Small shadow">

<style>
    @font-face {
        font-family: 'typographpro';
        src: url('../../assets/fonts/typographpro.ttf') format('truetype');
    }

    .fonttypograph{
        font-family: 'typographpro';
        letter-spacing: 0.5em;
        font-stretch: ultra-expanded;
        color: black;
    }
</style>

<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-custom py-3">
        <div class="container-fluid">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav me-auto">
                    <?php
                        if(isset($_SESSION['usuario'])):
                    ?>
                    <a class="dropdown-toggle nav-item custom-text-white"
                        href="#"
                        id="dropdownMenuButton1"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="../../assets/users/profile/<?=$_SESSION['imagem_perfil']?>"
                            class="rounded-circle border border-light border-2"
                            height="37"
                            alt=""
                        />
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="../profile.php">Ver Perfil</a></li>
                        <li><a class="dropdown-item" href="../..support.php">Ajuda</a></li>
                        <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
                    </ul>
                    <li class="nav-item active">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaUpload">Upload</button>
                    </li>
                    <?php
                        if(isset($_SESSION['adm'])):
                    ?>
                    <li class="nav-item">
                        <form action="../admin.php">
                            <button type="submit" class="btn btn-outline-light">Gerenciar</button>
                        </form>
                    </li>
                    <?php
                        endif;
                    ?>
                    <?php
                        else:
                    ?>
                    <li class="nav-item active">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaLogin">Entrar</button>
                    </li>
                    <li class="nav-item">
                        <button type="button"  class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#telaCadastro">Cadastrar-se</button>
                    </li>
                    <?php
                        endif;
                        if(isset($_SESSION['nao_autenticado'])):
                    ?>

                    <script type="text/javascript">
                        $(window).on('load',function(){
                        $('#telaLogin').modal('show');});
                    </script>
                    <?php
                        endif;
                    ?>

                    <?php
                        if(isset($_SESSION['status_cadastro'])):
                    ?>

                    <script type="text/javascript">
                        $(window).on('load',function(){
                        $('#telaCadastro').modal('show');});
                    </script>
                    <?php
                        endif;
                    ?>

                    <?php
                        if(isset($_SESSION['usuario_existe'])):
                    ?>

                    <script type="text/javascript">
                        $(window).on('load',function(){
                        $('#telaCadastro').modal('show');});
                    </script>
                    <?php
                        endif;
                    ?>

            </div>

            <div class="mx-auto order-0">
                <a class="navbar-brand mb-0 h1 mx-auto fonttypograph" href="../../index.php">TALENT</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <form class="d-flex" method="GET" action="../../users.php">
                                <input class="form-control me-2" type="search" placeholder="Pesquisar contas" name="userSearch" aria-label="Search">
                                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

</header>

<div class="modal fade" id="telaUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Postar seu talento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <?php if (isset($_GET['error'])) { ?>
                <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                    <div class="alert alert-danger" role="alert">
                        <?=$_GET['error']?>
                    </div>

                    <?php } ?>

                    <div class="alert alert-danger" role="alert">
                        ATENÇÃO: No momento só aceitamos upload em formato de URL de vídeo já postado no YouTube.
                    </div>
                    <form method="POST" action="../send.php">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Título</label>
                            <input type="text" name="titulo" required="required" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="text-black" for="exampleInputCategory1">Categoria</label>
                            <select class="form-select" name="categoria" required>
                                <option value="">- Selecione a Categoria (Mais opções em breve) - </option>
                                <option value="dança">Dança</option>
                                <option value="arte">Arte</option>
                                <option value="música">Música</option>
                                <option value="culinária">Culinária</option>
                                <option value="esporte">Esporte</option>
                                <option value="tecnologia">Tecnologia</option>
                                <option value="mágica">Mágica</option>
                                <option value="jogos">Jogos</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Descrição</label>
                            <input type="text" name="descricao" required="required" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Tags</label>
                            <input type="text" name="tags" required="required" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">URL do Vídeo no YouTube</label>
                            <input type="text" name="my_video" required="required" class="form-control" >
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" required="required" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label text-black" for="exampleCheck1">Li e aceito os <a href="terms.php" target="_blank">termos e condições.</a></label>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-black" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" name="submit" value="Upload" class="btn btn-outline-black">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
<div class="container">
    <div class="container2">
        <?php
            $query = "SELECT * from adm";
            $res = mysqli_query($conexao, $query);
            if(mysqli_num_rows($res) > 0){
                while($logs = mysqli_fetch_assoc($res)) {
        ?>

        <div class="shadow-none p-3 mb-5 bg-custom rounded">
            <h4 class="video-data2">
                <?=$logs['id']?>
            </h4>
            <h2 class="video-data2 video-data">
                Usuário que recebeu punição: <p class="biography2 log"><?=$logs['usuario_punido']?></p>
            </h2>
            <h2 class="video-data2 video-data">
                ID do vídeo excluído: <p class="biography2 log"><?=$logs['videoid']?></p>
            </h2>
            <h2 class="video-data2 video-data">
                Título do vídeo excluído: <p class="biography2 log"><?=$logs['titulo_video']?></p>
            </h2>
            <h2 class="video-data2 video-data">
                Administrador que aplicou a punição: <p class="biography2 log"><?=$logs['adm_acao']?></p>
            </h2>
            <h2 class="video-data2 video-data">
                Motivo da exclusão: <p class="biography2 log"><?=$logs['motivo_exclusao']?></p>
            </h2>
        </div>
        
        <?php
                }
            } else { 
        ?>

        <div class="shadow-none p-3 mb-5 bg-custom rounded especialpadd">
            <h3 class="text-center">Sem registros.</h3>
        </div>

        <?php
            } 
        ?>

        </div>        
    </div>
</div>

<footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-footer f-about">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="../../assets/img/logo/white-logo.svg" alt="Logo TALENT">
                                </a>
                            </div>
                            <p>Divulgue seus talentos!</p>
                            <ul class="social">
                                <li><a href="https://www.facebook.com/Plataforma-Talent-Brasil-101804075572449/" target = "_blank"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/TalentBrazil" target = "_blank"><i class="fab fa-twitter"></i></i></a></li>
                                <li><a href="https://www.instagram.com/plataforma.talent/" target = "_blank"><i class="fab fa-instagram"></i></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCII_fQ_xWjyCW6GsKfNpd0A" target = "_blank"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="single-footer f-link">
                                    <h3>Redes Sociais</h3>
                                    <ul>
                                        <li><a href="https://www.facebook.com/Plataforma-Talent-Brasil-101804075572449/" target = "_blank">Facebook</a></li>
                                        <li><a href="https://www.instagram.com/plataforma.talent/" target = "_blank">Instagram</a></li>
                                        <li><a href="https://twitter.com/TalentBrazil" target = "_blank">Twitter</a></li>
                                        <li><a href="https://www.youtube.com/channel/UCII_fQ_xWjyCW6GsKfNpd0A">YouTube</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="single-footer f-link">
                                    <h3>Suporte</h3>
                                    <ul>
                                        <li><a href="mailto:plataformatalentbrasil@gmail.com">E-mail de contato</a></li>
                                        <li><a href="../..support.php">Ajuda</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="single-footer f-link">
                                    <h3>Equipe</h3>
                                    <ul>
                                        <li><a href="../..about.php">Sobre</a></li>
                                        <li><a href="../..support.php">Fale Conosco</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="single-footer f-link">
                                    <h3>Sua Conta</h3>
                                    <ul>
                                        <li><a href="../..terms.php">Termos e Condições</a></li>
                                        <li><a href="../profile.php">Meu Perfil</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<a href="#" class="scroll-top">
    <i class="fas fa-angle-up"></i>
</a>

</body>
</html>
