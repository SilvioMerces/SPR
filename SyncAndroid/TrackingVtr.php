<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$prefixo = $_REQUEST['prefixo'];
$latitude = $_REQUEST['latitude'];
$longitude = $_REQUEST['longitude'];
$nrfone = $_REQUEST['nrfone'];
$dth = $_REQUEST['dth'];


require_once '../Libs/php/Conect.class.php';
require_once '../Modulos/TrackingVtr/Trackinvtr.class.php';


$track = new Trackinvtr($prefixo,$latitude,$longitude,$dth,$nrfone);

$track->AddTracking();
echo "adicionado ".$track->getId();