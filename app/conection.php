<?php
    $isDocker = getenv('DOCKER_ENVIRONMENT') === 'true' || file_exists('/.dockerenv');
    $defaultHost = $isDocker ? 'db:3306' : 'localhost:3307';
    
    define('HOST', getenv('DB_HOST') ? getenv('DB_HOST') : $defaultHost);
    define('USUARIO', getenv('DB_USER') ? getenv('DB_USER') : 'root');
    define('SENHA', getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'root');
    define('DB', getenv('DB_NAME') ? getenv('DB_NAME') : 'talentdb');

    $conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

    if (!$conexao) {
        die('Erro de conexão: ' . mysqli_connect_error());
    }

    mysqli_set_charset($conexao, "utf8");
?>
