<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'Visita.class.php';

$Prod = new Visita;
$Prod->setVisita($_REQUEST);
$Prod->setFoto($_FILES["foto"]["tmp_name"]);
echo $Prod->AddVisita();
