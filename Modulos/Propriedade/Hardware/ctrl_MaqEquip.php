<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

require_once '../../../Libs/php/Conect.class.php';
require_once './MaqEquip.class.php';

$Db = new Conect;

chdir('../../../spr_files');
$dir = getcwd();



if (is_numeric($_REQUEST['id'])) {
    ($_REQUEST['id']) > 0 ? $r = 'alterar' : $r = 'incluir';
} else {
    $r = "incluir";
}


if ($r === 'alterar') {

    if ($_FILES['foto']['tmp_name'] != '') {

        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
        $destpath = 'MaqEquip_' . $_REQUEST['id'] . $tipo;
        file_put_contents($dir . "/$destpath", $foto);
        $_REQUEST['foto'] = "/spr_files/$destpath";
    }

    $MaqEquip = new MaqEquip();
    $MaqEquip->setMaqEquip($_REQUEST);
    $Db->AltObjeto($MaqEquip);
    echo $_REQUEST['id'];
} else {

    isset($_REQUEST['foto']) ?: $_REQUEST['foto'] = '';

    $MaqEquip = new MaqEquip;
    $MaqEquip->setMaqEquip($_REQUEST);

    $id = $Db->AddObjeto($MaqEquip);

    if ($_FILES['foto']['tmp_name'] != '') {

        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
        $destpath = 'MaqEquip_' . $id . $tipo;
        file_put_contents($dir . "/$destpath", $foto);

        $MaqEquip->setFoto("/spr_files/$destpath");
        $MaqEquip->setId($id);
        $Db->AltObjeto($MaqEquip);
    }
    return $id;
}

unset($Marca);
unset($Db);
