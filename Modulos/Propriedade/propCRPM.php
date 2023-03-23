<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');

require_once 'Libs/php/Conect.class.php';
$con = new Conect;
$row = '';

/*
 * pegar todos os crpms
 * SELECT * FROM public.organizacao where id_superior=48604; 48604(Orgãos de execução)
 * pegar todos os municipios de Goiás
 * SELECT * FROM public.muncipios_opm_crpm;
 */

function addMarker($propriedade) {
    
    
   // print_r($propriedade->cod_propriedade);
    
    $urlbase = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];

    if (strrpos($urlbase, 'Modulos') !== false) {
        $urlbase = substr($urlbase, 0, strrpos($urlbase, 'Modulos'));
    } else {
        $urlbase = substr($urlbase, 0, strrpos($urlbase, 'index'));
    }

    $link = "\"<a style='font-weight: bolder;' onclick=\\\"ObjProcAjax.run('$urlbase/Modulos/Propriedade/formPropriedade.php?id=" . addslashes($propriedade->id) . "','Corpo')\\\">" . "Nome da Propriedade : " . addslashes($propriedade->nome) . "</a><br>";

    return ",\n ["
            . addslashes($propriedade->lat) . "," . addslashes($propriedade->log) . ","
            . $link
            . "Atividade Principal : " . addslashes($propriedade->id_atividade) . "<br>"
            . "Município : " . addslashes($propriedade->id_cidade) . "<br>"
            . "Referencia : " . addslashes($propriedade->referencia) . "<br>"
            . "Numero da Propriedade : " . addslashes($propriedade->nr_propriedade) . "<br>Lat:"
            . "GeoReferencia : " . addslashes($propriedade->lat) . "<br>"
            . addslashes($propriedade->log) . "\"]\n";
     
     
    
}


$propriedades = $con->Sql("SELECT "
        . "id,"
        . "nome,"
        . "id_atividade,"
        . "id_cidade,"
        . "referencia,"
        . "lat,"
        . "log,"
        . "nr_propriedade "
        . "tipoprop "
        . "FROM propriedade");


while ($propriedade = current($propriedades)) {
    $row .= addMarker($propriedade);
    next($propriedades);
}

echo "var addressPoints = [" . substr($row, 1) . "];\n";
//  $ct++;
$row = '';
//}
?>