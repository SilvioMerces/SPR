<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'Colaborador.class.php';
require_once '../../../Libs/php/Conect.class.php';
require_once '../../../Libs/php/util.php';

$Colab = new Colaborador();

$Db = new Conect();
$ut = new util();


if (isset($_REQUEST['id'])) {
    $colaborador = $Db->Sql("SELECT * FROM colaborador WHERE id = {$_REQUEST['id']};");
    $Colab->setColaborador($colaborador[0]);
}
?>

<form id="formColaborador" action="Modulos/Propriedade/Colaborador/ctrl_colaborador.php" method="POST" enctype="Multipart/form-data"  onsubmit="return false;" >
    <input type="hidden" name="id" id="id_colaborador" value="<?php echo $Colab->getId(); ?>"/>
    <input type="text" name="id_propriedade" id="id_propriedade" value="<?php echo $_REQUEST['id_propriedade'] ?>" />
    <div class="col coll-3">
        <span>
            <label for="foto">Foto<input type="file" name="foto" id="foto"  accept=".png,.jpg,.jpeg" onchange="readURL(this, 'fotocolab');" value="<?= $Colab->getFoto(); ?>"  />
                <img id="fotocolab" class="foto3x4" alt="foto 3x4" src="../../../Templates/imgs/spr_image.php?img=<?php echo $_SERVER['HTTP_REFERER'] . "/" . $Colab->getFoto() . '&' . date('dmYHis'); ?>"   />-->
            </label>
        </span>
    </div>
    <div class="col coll-3">
        <span><label>Nome do Colaborador:</label><input type="text" name="nome" id="nome" value="<?php echo $Colab->getNome(); ?>"/> </span>
        <span><label>CPF:</label><input type="text" name="cpf" id="cpf" value="<?php echo $Colab->getCpf(); ?>"/></span>
        <span><label>RG:</label><input type="text" name="rg" id="rg" value="<?php echo $Colab->getRg(); ?>"/></span>

        <span>
            <label>Sexo</label>
            <p><input type="radio" name="sexo" id="sexo" value="1" <?php if ($Colab->getSexo() == 1) echo 'checked'; ?>> M </p>
            <p><input type="radio" name="sexo" id="sexo" value="2" <?php if ($Colab->getSexo() == 2) echo 'checked'; ?>> F</p>
        </span>

        <span><label>Tipo Colaborador</label><select id="tipopess" name="tipopess" ><?php echo $ut->populaSelect('tipo', 'id', 'tipopess', null, 'id', $Colab->getTipopess()) ?></select></span>
    </div>
    <div class="col coll-3">
        <span><label>Naturalidade</label><input type="text" name="naturalidade" id="naturalidade" value="<?php echo $Colab->getNaturalidade(); ?>" /></span>
        <span><label>Nome do Pai</label><input type="text" name="pai" id="pai" value="<?php echo $Colab->getPai(); ?>" /></span>
        <span><label>Nome da Mãe</label><input type="text" name="mae" id="mae" value="<?php echo $Colab->getMae(); ?>"/> </span>
        <span><label>Data de Nascimento</label><input type="text" name="dn" id="dn"  value="<?php echo$Colab->getDn(); ?>"/></span>        
    </div>

    <div class="tollbar">
        <input type="submit" id="acao_colaborador" name="acao" value="Incluir" onclick="return ValidaFormColaborador('formColaborador');ObjProcAjax.runPost('Modulos/Propriedade/Colaborador/ctrl_colaborador.php', null, 'formColaborador', 'addColaborador');" />
        <input id="reset_colaborador" type="reset" value="Cancelar" />
    </div>
</form>

<script type="text/javascript">

    document.getElementById('tipopess').value =<?php echo $Colab->getTipopess() ?>;

</script>

<style>
    #fotocolab{
        float: left;
        display: inline-block;
        margin:5px;
        height: 150px !important;
        width: 115px !important;
        border-radius: 5px;
        box-shadow: 3px 3px 3px gray;
        border:1px solid black;
    }

    #fotocolab:after{
        content: "sem foto";
        text-align: center;
        float: left;
        position: relative;
        background-color: #f0f0f0;
        text-align: center;
        border:0px dotted red;
        top:-1.2em;
        height:148px;
        width:113px;
        border-radius: 5px;
    }
</style>