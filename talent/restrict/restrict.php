<?php
session_start();
if(!$_SESSION['adm']){
    header('Location: ../index.php');
    exit();
}
