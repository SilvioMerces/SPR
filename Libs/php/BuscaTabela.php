<?php
header('Content-Type: text/html; charset=utf-8');

require_once 'Conect.class.php';
$con = new Conect;

$_REQUEST['restricao']==='busca'? $restricao = 'upper(CONCAT_WS(nr_propriedade,nome,cidade,nome_colaborador))':$restricao=$_REQUEST['restricao'];

if (strtolower($_REQUEST['operador']) == 'like') {
    if (empty(trim($_REQUEST['busca']))) {
        $SQL_BUSCA = "SELECT {$_REQUEST['campos']} FROM {$_REQUEST['para']} {$_REQUEST['parametros']}";
    } else {
        $SQL_BUSCA = "SELECT {$_REQUEST['campos']} FROM {$_REQUEST['para']} WHERE $restricao {$_REQUEST['operador']} upper('%" . $_REQUEST['busca'] . "%') {$_REQUEST['parametros']}";
    }
} else {
    if (empty(trim($_REQUEST['busca']))) {
        $SQL_BUSCA = "SELECT {$_REQUEST['campos']} FROM {$_REQUEST['para']} {$_REQUEST['parametros']}";
    } else {
        $SQL_BUSCA = "SELECT {$_REQUEST['campos']} FROM {$_REQUEST['para']} WHERE $restricao {$_REQUEST['operador']} {$_REQUEST['busca']} {$_REQUEST['parametros']}";
    }
}
//echo $SQL_BUSCA;

$result = $con->Sql($SQL_BUSCA);

$jsonString = '[{';
foreach ($result as $objs) {
    foreach ($objs as $key => $value) {
        $string .= '"' . $key . '":"' . $value. '",';
    };
    $jsonString .= substr($string, 0, strlen($string) - 1) . '},{';
};

echo substr($jsonString, 0, strlen($jsonString) - 2) . "]";