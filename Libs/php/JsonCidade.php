<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

require_once 'Conect.class.php';
$CON = new Conect();

if (isset($_REQUEST['id'])) {
    $sql = "SELECT
  view_crpm.id as id_crpm,
  view_crpm.sigla as sigla_crpm,
  view_opm.id as id_opm,
  view_opm.sigla as sigla_opm,
  municipio.codigo_ibge as id,
  municipio.nome,
  municipio.latitude,
  municipio.longitude
FROM
  view_crpm 
  LEFT JOIN view_opm ON view_opm.id_superior = view_crpm.id
  LEFT JOIN municipio_opm ON municipio_opm.cod_opm = view_opm.id
  LEFT JOIN municipio ON municipio.codigo_ibge = municipio_opm.codigo_ibge
WHERE view_opm.id={$_REQUEST['id']};";
} else {
    $sql = "SELECT
  view_crpm.id as id_crpm,
  view_crpm.sigla as sigla_crpm,
  view_opm.id as id_opm,
  view_opm.sigla as sigla_opm,
  municipio.codigo_ibge as id,
  municipio.nome,
  municipio.latitude,
  municipio.longitude
FROM
  view_crpm 
  LEFT JOIN view_opm ON view_opm.id_superior = view_crpm.id
  LEFT JOIN municipio_opm ON municipio_opm.cod_opm = view_opm.id
  LEFT JOIN municipio ON municipio.codigo_ibge = municipio_opm.codigo_ibge;";
   
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