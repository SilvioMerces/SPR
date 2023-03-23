<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<span class="row">
    <img src="../../../Templates/imgs/btn_add.svg" id="addColab" onclick="ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Hardware/FrmMaqEquip.php?propriedade_id=<?= $_REQUEST['propriedade_id']; ?>', 'tabcontent');return null" />
</span>
<?php
$sql = 'SELECT id,propriedade_id,foto,chassi,marca,modelo,descricao FROM prop_maqequip where propriedade_id =' . $_REQUEST['propriedade_id'] . ';';

require_once '../../../Libs/php/Conect.class.php';
$bd = new Conect();
$MarqEquips = $bd->Sql($sql);

if (count($MarqEquips) > 0) {
    while ($MaqEquip = current($MarqEquips)) {

        echo"<span class='row'  onclick=\"ObjProcAjax.run(Base_URL+'/Modulos/Propriedade/Hardware/FrmMaqEquip.php?id={$MaqEquip->id}&propriedade_id={$MaqEquip->propriedade_id}','tabcontent');document.getElementById('tab2').checked = true;return null;\" >"
        . "<img src=\"../../Templates/imgs/spr_image.php?img=".$_SERVER['HTTP_REFERER']."{$MaqEquip->foto}&" . date('dmYHis') . "\" alt='Foto' >"
        . "<span class='rowTit'>{$MaqEquip->descricao}</span>"
        . "</span>";

        next($MarqEquips);
    }
} else {
    echo"<span class='row'>"
    . "<span class='rowTit'>Nâo há Maquinas ou Equipamentos cadastrados nesta propriedade</span>"
    . "</span>";
}
unset($bd);
?>
<style>
    .row img{
        height:3em;
        width:3em;
        border-radius: 5px;
        float: left;
        display: inline-block;
        margin:5px;
    }

    .row img:after{
        content: "sem foto";
        text-align: center;
        float: left;
        position: relative;
        top:-1.3em;
        height:3.2em;
        width:3.2em;
        border-radius: 5px;
    }

    .row .rowTit{
        margin-top: 0.5em;
        width: calc( 100% - 4em)
    }

    #addColab{
        height: 1.5em;
    }
</style>

