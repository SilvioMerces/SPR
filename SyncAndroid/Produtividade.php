<?php
require_once '../Libs/php/Conect.class.php';
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

require_once '../Modulos/Produtividade/Produtividade.class.php';

$Prod = new Produtividade($_REQUEST);


$Prod->AddProdutividade();