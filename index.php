<?php
/**
 * Arquivo de inicialização da aplicação
 * Redireciona para a pasta talent onde está a aplicação principal
 */

include_once __DIR__ . '/app/config.php';

header("Location: talent/");
exit; 