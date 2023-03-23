<?php
  ini_set('display_errors', 'Off');
  error_reporting(E_ALL);
  
if ($_FILES['foto']['tmp_name'] != '') {

    require_once '../../../Libs/php/Conect.class.php';
    require_once 'Fachada.class.php';
    $obj = new Fachada;

    $obj->setFachada($_REQUEST);

    $Db = new Conect;

    chdir('../../../spr_files');
    $dir = getcwd();


    ($obj->getId()) > 0 ? $r = 'alterar' : $r = 'incluir';

    $foto = file_get_contents($_FILES['foto']['tmp_name']);

    $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));

    $destpath = 'Fachada_' . $_REQUEST['propriedade_id'] . '.png';

    file_put_contents($dir."/$destpath", $foto);

    $obj->setFoto("/spr_files/$destpath");

    if ($r === 'alterar') {
        echo $Db->AltObjeto($obj);
        echo "Fachada alterada com Sucesso!";
    } else {
        echo $Db->AddObjeto($obj);
    }

    unset($obj);
    unset($Db);
}
?>