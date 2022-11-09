<?php
    $now = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
    $hours = $now->format('H:i');
    
    $dtDay = new DateTime;
    $dtDay->setTime(5, 0);
    $dtEvening = new DateTime;
    $dtEvening->setTime(12, 0);
    $dtNight = new DateTime;
    $dtNight->setTime(18, 0);

    $dtDayConv = $dtDay->format('H:i');
    $dtEveningConv = $dtEvening->format('H:i');
    $dtNightConv = $dtNight->format('H:i');

    //echo $dtDayConv;
        
    //echo $dtEveningConv;

    //echo $dtNightConv;


    if ($hours >= $dtDayConv && $hours < $dtEveningConv) {
        $saudacao = "Bom dia";
    } elseif ($hours >= $dtEveningConv && $hours < $dtNightConv) {
        $saudacao = "Boa tarde";
    } else {
        $saudacao = "Boa noite";
    }
    
    //echo $saudacao;

?>