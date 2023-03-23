<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

require_once 'MaqEquip.class.php';
require_once '../../../Libs/php/Conect.class.php';
require_once '../../../Libs/php/util.php';

$MaqEquip = new MaqEquip;
$Db = new Conect();
$ut = new util();

if (isset($_REQUEST['id'])) {
    $MaqEquips = $Db->Sql("SELECT * FROM prop_maqequip WHERE id = {$_REQUEST['id']};");
    $MaqEquip->setMaqEquip($MaqEquips[0]);
}
?>
<script type="text/javascript" >
    function mudaMarca(idselect, id) {
        select = document.getElementById(idselect);
        PopulaSelect(select, '../../Libs/php/JsonMarca.php?id=' + id);
    }
</script>
<form id="formHardware" action="Modulos/Propriedade/Hardware/ctrl_MaqEquip.php" method="POST" enctype="Multipart/form-data"  onsubmit="return false;" >
    <input type="hidden" name="id" id="id_MaqEquip" value="<?php echo $MaqEquip->getId(); ?>"/>
    <input type="hidden" name="propriedade_id" id="propriedade_id" value="<?php echo $_REQUEST['propriedade_id'] ?>" />

    <div class="col col-2">
        <label>Chassi / Nr de Serie:</label><input type="text" name="chassi" id="chassi" value="<?php echo $MaqEquip->getChassi(); ?>"/> 
        <label>Categoria:</label><select name="categoria" id="categoria" onchange="mudaMarca('marca', this.value)" >
            <?php echo $ut->populaSelect('categoria', 'id', 'implementos_agricolas', null, 'id') ?>
        </select> 
        <label>Marca:</label><select name="marca" id="marca" ><option>Selecione a Categoria</option></select> 
        <label>Modelo:</label><input type="text" name="modelo" id="modelo" value="<?php echo $MaqEquip->getModelo(); ?>"/> 
        <label>Descrição:</label><textarea name="descricao" id="descricao"> <?php echo $MaqEquip->getDescricao(); ?></textarea> 
    </div>

    <div class="col col-2">
        <label for="foto" class="fotomarca" >Foto
            <input type="file" name="foto" id="foto"  accept=".png,.jpg,.jpeg" onchange="readURL(this, 'fotoMarca');" value="<?= $MaqEquip->getFoto(); ?>"  />
            <img id="fotoMarca" alt="foto marca" src="../../../Templates/imgs/spr_image.php?img=<?php echo $_SERVER['HTTP_REFERER'] . $MaqEquip->getFoto() . '&' . date('dmYHis'); ?>"   />
        </label>
    </div>

    <div class="tollbar">
        <input type="submit" id="acao_MaqEquip" name="acao" value="Incluir" onclick="ObjProcAjax.runPost('Modulos/Propriedade/Hardware/ctrl_MaqEquip.php', null, 'formHardware', 'addMaqEquip');" />
        <input id="reset_id_marca" type="reset" value="Cancelar" />
    </div>
</form>

<script type="text/javascript">

    document.getElementById('categoria').value = <?php echo $MaqEquip->getCategoria(); ?>;
    mudaMarca('marca',<?php echo $MaqEquip->getCategoria(); ?>);
    document.getElementById('marca').value = <?php echo $MaqEquip->getMarca(); ?>;

<?php
if (isset($_REQUEST['id'])) {
    ?>
        document.getElementById('acao_MaqEquip').value = 'Alterar';
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