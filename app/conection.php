<?php
    define('HOST', 'localhost:3306');
    define('USUARIO', 'root');
    define('SENHA', 'root');
    define('DB', 'talentdb');
    $conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Erro!');
?>
