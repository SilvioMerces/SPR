<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$_SESSION['USER']=1;
/*
 * retorna as opms do CRPM informado
 * @id deve ser o id do crpm
 * 
 */
require_once 'Conect.class.php';
$CON = new Conect();


if (isset($_REQUEST['id'])) {
    $sql = "SELECT id,nome_marca as nome FROM marca_implemento WHERE implemento_id={$_REQUEST['id']};";
} else {
    $sql = "SELECT id,nome_marca as nome FROM marca_implemento;";
}

$dados = $CON->Sql($sql);

$jsonString = '{"obj":[{';

foreach ($dados as $objs) {
    foreach ($objs as $key => $value) {
        $string .= '"' . $key . '":"' . $value. '",';
    };
    $jsonString .= substr($string, 0, strlen($string) - 1) . '},{';
};

echo substr($jsonString, 0, strlen($jsonString) - 2) . "]}";