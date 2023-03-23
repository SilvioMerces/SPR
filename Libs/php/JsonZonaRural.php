<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');

session_start();
$_SESSION['USER'] = 1;
/*
 * retorna as opms do CRPM informado 
 * @id deve ser o id do crpm
 * 
 */
require_once 'Conect.class.php';
$ObjCon = new Conect;

if (isset($_REQUEST['id'])) {
    header('Content-type: text/html; charset=UTF-8');
    $sql = "SELECT id,nome,id_cidade FROM zona_rural WHERE id_cidade={$_REQUEST['id']};";
    $result = $ObjCon->Sql($sql);

    if (count($result) > 1) {
        echo '{"obj":' . json_encode($result) . '}';
    } else {
        echo '{"obj":[{"id":"","nome":"Sem Zona Rural Cadastrada","id_cidade":""}]}';
    }
} else {

    echo '{"obj":[{"id":"","nome":"Sem Zona Rural Cadastrada","id_cidade":""}]}';
}

