<?php
require_once '../../../Libs/php/util.php';
$ut = new util;
?>

<div class="tab">
    <input type="radio" id="tab1" name="tab" /><label for="tab1" onclick="ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Viveres/ListaMarcaViveres.php?propriedade_id=<?= $_REQUEST['propriedade_id']; ?>', 'tabcontent');return null;">Lista de Marcas</label>
    <input type="radio" id="tab2" name="tab" /><label  onclick="return null;" >Ficha da Marca</label>
</div>

<div id="tabcontent" class="tabcontent"></div>

<script>
    ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Viveres/ListaMarcaViveres.php?propriedade_id=<?= $_REQUEST['propriedade_id']; ?>', 'tabcontent');
    document.getElementById('tab1').checked = true;
</script>