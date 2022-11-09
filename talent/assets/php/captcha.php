<?php

$secret = "6LdumJ4cAAAAACcC7v3HnibltWcYKnx07G7-31-q";
$response = null;
$reCaptcha = new reCaptcha($secret);

if(isset($_POST['g-recaptcha-response'])){
    $response = $reCaptcha->verifyResponse($_SERVER['REMOTE-ADDR'], $_POST['g-recaptcha-response']);
}

?>