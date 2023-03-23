<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../Libs/php/Conect.class.php';

$con = new Conect();

$SQL_BUSCA="SELECT id,nome,nr_propriedade,lat,log FROM `propriedade` WHERE `nr_propriedade` like '%{$_REQUEST['busca']}%' ";

$result = $con->Sql($SQL_BUSCA);

$jsonString = '[';

foreach ($result as $objs) {
   $campo='{';
    foreach ($objs as $key => $value) {
        $campo .= "\"$key\":\"$value\",";
    };
    $jsonString.= substr($campo, 0, strlen($campo)-1)."},";
};

$jsonString= substr($jsonString, 0, strlen($jsonString)-1).']';

echo $jsonString;