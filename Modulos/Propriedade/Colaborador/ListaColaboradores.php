<span class="row">
    <img src="../../../Templates/imgs/btn_add.svg" id="addColab" onclick="ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Colaborador/FrmColaborador.php?id_propriedade=<?= $_REQUEST['id_propriedade']; ?>', 'tabcontent');return null" />
</span>
<?php
$sql = 'SELECT id,id_propriedade,nome,cpf,rg,sexo,tipopess,naturalidade,pai,mae,dn,foto FROM colaborador where id_propriedade =' . $_REQUEST['id_propriedade'] . ';';

require_once '../../../Libs/php/Conect.class.php';
$bd = new Conect();
$Colabs = $bd->Sql($sql);

function contato($bd, $idpessoa) {
    $contatos = $bd->Sql("SELECT array_to_string(array_agg(telefone),', ') as contatos FROM contatos WHERE id_pessoa=$idpessoa");
    return $contatos[0]->contatos;
}

while ($colab = current($Colabs)) {

    echo"<span class='row'  onclick=\"ObjProcAjax.run(Base_URL+'/Modulos/Propriedade/Colaborador/FrmColaborador.php?id={$colab->id}&id_propriedade={$colab->id_propriedade}','tabcontent');document.getElementById('tab2').checked = true;return null;\" >"
    . "<img src=\"../../../../Templates/imgs/spr_image.php?img=" . substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], '://') + 3) . "{$_SERVER['SERVER_NAME']}/{$colab->foto}&" . date('dmYHis') . "\" alt='Foto' >"
    . "<span class='rowTit'>{$colab->nome}</span>"
    . "<span class='rowDetail'>Filiação: {$colab->pai} / {$colab->mae} Contatos: " . contato($bd, $colab->id) . "</span>
</span>";

    next($Colabs);
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
        background-color: #f0f0f0;
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