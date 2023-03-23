<?php

require_once '../../Libs/php/Conect.class.php';
require_once './Propriedade.Class.php';

$Prop = new Propriedade($_REQUEST);
$Db = new Conect;

($Prop->getId()) > 0 ? $r= 'alterar' : $r= 'incluir';



if ($r === 'alterar') {
   echo $Db->AltObjeto($Prop);
    
} else {
    echo $Db->AddObjeto($Prop);
}

unset($Prop);
?>