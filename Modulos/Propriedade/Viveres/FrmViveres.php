<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'MarcaViveres.class.php';
require_once '../../../Libs/php/Conect.class.php';
require_once '../../../Libs/php/util.php';

$Marca = new MarcaViveres();
$Db = new Conect();
$ut = new util();

if (isset($_REQUEST['id'])) {
    $Marcas = $Db->Sql("SELECT * FROM prop_marcaviveres WHERE id = {$_REQUEST['id']};");
    $Marca->setMarcaViveres($Marcas[0]);
}
?>
<form id="formViveres" action="Modulos/Propriedade/Viveres/ctrl_marcaviveres.php" method="POST" enctype="Multipart/form-data"  onsubmit="return false;" >
    <input type="hidden" name="id" id="id_marca" value="<?php echo $Marca->getId(); ?>"/>
    <input type="hidden" name="propriedade_id" id="propriedade_id" value="<?php echo $_REQUEST['propriedade_id'] ?>" />
    <div class="col col-2">
        <label>Descrição da Marca:</label><input type="text" name="descricao" id="descricao" value="<?php echo $Marca->getDescricao(); ?>"/> 
    </div>
    <div class="col col-2">
        <label for="foto" class="fotomarca" >Foto
            <input type="file" name="foto" id="foto"  accept=".png,.jpg,.jpeg" onchange="readURL(this, 'fotoMarca');" value="<?= $Marca->getFoto(); ?>"  />
            <img id="fotoMarca" alt="foto marca" src="../../../Templates/imgs/spr_image.php?img=<?php echo $_SERVER['HTTP_REFERER'].$Marca->getFoto() . '&' . date('dmYHis'); ?>"   />
        </label>
    </div>
    
    <div class="tollbar">
        <input type="submit" id="acao_id_marca" name="acao" value="Incluir" onclick="ObjProcAjax.runPost('Modulos/Propriedade/Viveres/ctrl_marcaviveres.php', null, 'formViveres', 'addMarca');" />
        <input id="reset_id_marca" type="reset" value="Cancelar" />
    </div>
</form>
<script>
<?php
if (isset($_REQUEST['id'])) {
    ?>
        document.getElementById('acao_id_marca').value = 'Alterar';
    <?php
}
?>
</script>
<style>

    #fotoMarca{
        display: block;
        border: 1px solid silver;
        width: 400px !important;
        height: 300px !important;

    }
    #formHardware .tollbar{
        width: 95% !important;
    }
</style>