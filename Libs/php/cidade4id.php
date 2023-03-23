<?php
//ini_set('display_errors', 'Off');
//error_reporting(E_ALL);

require_once 'Conect.class.php';
$CON = new Conect();

$sql = "SELECT latitude,longitude,nome FROM municipio WHERE municipio.codigo_ibge='{$_REQUEST['id']}'";

$dados = $CON->Sql($sql);
 
$jsonString = '{"obj":[{';

foreach ($dados as $objs) {
    foreach ($objs as $key => $value) {
        $string .= '"' . $key . '":"' . $value. '",';
    };
    $jsonString .= substr($string, 0, strlen($string) - 1) . '},{';
};

echo substr($jsonString, 0, strlen($jsonString) - 2) . "]}";