<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once '../../../Libs/php/Conect.class.php';
require_once './MarcaViveres.class.php';

$Db = new Conect;

chdir('../../../spr_files');
$dir = getcwd();

($_REQUEST['id']) > 0 ? $r = 'alterar' : $r = 'incluir';


if ($r === 'alterar') {

    if ($_FILES['foto']['tmp_name'] != '') {

        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
        $destpath = 'MarcaViveres_' . $_REQUEST['id'] . $tipo;
        file_put_contents($dir."/$destpath", $foto);
        $_REQUEST['foto'] = "/spr_files/$destpath";
    }

    $Marca = new MarcaViveres();
    $Marca->setMarcaViveres($_REQUEST);

    $Db->AltObjeto($Marca);
    echo 'Marca Alterada com Sucesso!';
    
} else {
    isset($_REQUEST['foto']) ?: $_REQUEST['foto'] = '';
    $Marca = new MarcaViveres;
    $Marca->setMarcaViveres($_REQUEST);
    $id = $Db->AddObjeto($Marca);

    if ($_FILES['foto']['tmp_name'] != '') {

        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
        $destpath = 'MarcaViveres_' . $id . $tipo;
        file_put_contents($dir."/$destpath", $foto);

        $Marca->setFoto("/spr_files/$destpath");
        $Marca->setId($id);
        $Db->AltObjeto($Marca);
        echo 'Marca Incluida com Sucesso!';
    }
    return $id;
}

unset($Marca);
unset($Db);
