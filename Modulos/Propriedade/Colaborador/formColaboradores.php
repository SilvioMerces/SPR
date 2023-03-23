<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once '../../../Libs/php/util.php';
$ut = new util;
?>

<div class="tab">
    <input type="radio" id="tab1" name="tab" /><label for="tab1" onclick="ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Colaborador/ListaColaboradores.php?id_propriedade=<?= $_REQUEST['id_propriedade']; ?>', 'tabcontent');return null;">Lista de Colaboradores</label>
    <input type="radio" id="tab2" name="tab" /><label  onclick="return null;" >Ficha de Colaborador</label>
</div>

<div id="tabcontent" class="tabcontent"></div>

<script>
    ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Colaborador/ListaColaboradores.php?id_propriedade=<?= $_REQUEST['id_propriedade']; ?>', 'tabcontent');
    document.getElementById('tab1').checked = true;
</script>