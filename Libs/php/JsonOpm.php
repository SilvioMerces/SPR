<?php

ini_set('display_errors', 'Off');
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');
session_start();

require_once 'Conect.class.php';
$CON = new Conect();

if (isset($_REQUEST['id'])) {
    $sql = "SELECT id,sigla as nome,id_superior FROM view_opm WHERE id_superior={$_REQUEST['id']} order by id";
    $dados = $CON->Sql($sql);
} else {
    $sql = "SELECT id,sigla as nome,id_superior FROM view_opm order by id";
    $dados = $CON->Sql($sql);
}

$jsonString = '{"obj":[{';

foreach ($dados as $objs) {
    foreach ($objs as $key => $value) {
        $string .= '"' . $key . '":"' . $value. '",';
    };
    $jsonString .= substr($string, 0, strlen($string) - 1) . '},{';
};

echo substr($jsonString, 0, strlen($jsonString) - 2) . "]}";
