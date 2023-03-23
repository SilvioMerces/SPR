<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../Modulos/Produtividade/Visita.class.php';

$vis = new Visita(); 
$vis->setVisita($_REQUEST);
$vis->AddVisita();

$tipo; /* 20580 = monitoramento; 30187 = Visita Comunitária Rural; 30176 = Visita Solidaria */
