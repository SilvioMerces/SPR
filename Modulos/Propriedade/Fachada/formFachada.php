<?php
require_once 'Fachada.class.php';
require_once '../../../Libs/php/Conect.class.php';
require_once '../../../Libs/php/util.php';

$obj = new Fachada;

$Db = new Conect();
$ut = new util();

if (isset($_REQUEST['propriedade_id'])) {
    $fachada = $Db->Sql("SELECT * FROM prop_fachada WHERE propriedade_id = {$_REQUEST['propriedade_id']};");
    $obj->setFachada($fachada[0]);
}
?>
<form id="formFachada" action="Modulos/Propriedade/Fachada/ctrl_Fachada.php" method="POST" enctype="Multipart/form-data"  onsubmit="return false;" >
    <input type="hidden" name="id" id="id_fachada" value="<?php echo $obj->getId(); ?>"/>
    <input type="hidden" name="propriedade_id" id="propriedade_id" value="<?php echo $_REQUEST['propriedade_id'] ?>" />
    <div class="col col-2">
        <span>
            <label for="foto">Foto<input type="file" name="foto" id="foto"  accept=".png,.jpg,.jpeg" onchange="readURL(this, 'fotofachada');" value="<?= $obj->getFoto(); ?>"  />
                <?php
                if ($obj->getPropriedade_id() != '') {

                    $destpath = $_SERVER['HTTP_REFERER'] . '/spr_files/Fachada_' . $_REQUEST['propriedade_id'] . '.png';
                    echo '<img id="fotofachada"  alt="foto" src="data:image/gif;base64,' . base64_encode(file_get_contents($destpath)) . '"   />';
                } else {
                    echo '<img id="fotofachada"  alt="foto" src="../../Templates/imgs/spr_image.php?img=/spr_files/fachada.png"   />';
                }
                ?>
            </label>
        </span>
    </div>
    <div class="tollbar">
        <?php
        if (empty($obj->getId())) {
            echo '<input type="submit" id="acao_colaborador" name="acao" value="Incluir" onclick="ObjProcAjax.runPost(\'Modulos/Propriedade/Fachada/ctrl_Fachada.php\', null, \'formFachada\',\'addFachada\');" />';
        } else {
            echo '<input type="submit" id="acao_colaborador" name="acao" value="Alterar" onclick="ObjProcAjax.runPost(\'Modulos/Propriedade/Fachada/ctrl_Fachada.php\', null, \'formFachada\',\'addFachada\');" />';
        }
        ?>

        <input id="reset_fachada" type="reset" value="Cancelar" />
    </div>
</form>

<style>
    #formDetail #fotofachada{
        width: 400px;
        height: 300px;
        border: 1px solid azure;

    }
</style>