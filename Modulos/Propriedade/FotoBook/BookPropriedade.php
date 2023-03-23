<style>
    .Book>.Title{
        background-color: whitesmoke;
        border-bottom: 2px solid #c8c8c8;
        width: 100%;
        display: inline-block;
        margin-bottom: 0.5em;
        margin-top: 0.5em;
    }
    .Book>img{
        height: 120px;
        padding: 0.2em;
        border: dashed 1px aliceblue;
        background-color: antiquewhite;
        margin: 0.3em;
    }

    .Book{
        overflow: auto;
        height: 99%;
        width: 100%;
    }

    .Book ul{
        display: inline-block;
        position: absolute;
        top: 2em;
        right: 0.8em;
        width: 12em;
        padding: 0;
        list-style: none;
        padding: 0.3em;
        height: 89%;

    }    

    .Book ul:hover li{
        display: block;
    }

    .Book ul li{
        display: none;
        height: 16.8%;
        background-image: url(Templates/imgs/textMarker.svg);
        background-repeat: repeat-y;
        background-position: right;
        background-color: white;
    }

    .Book ul a{
        margin-right: 6px;
        color: black;
        text-decoration:none;
        float: right;
        display: block;
    }

    .Book ul a:visited{
        color: black;
        text-decoration:none;

    }


    .Book ul a:link{
        color: black;
        text-decoration:none;
    }

    #zoom{
        display: none;
        position: absolute;
        margin-top: -60%;
        margin-left: calc( 50% -320px);
        width: 80%;
        height: 60%;
        background:no-repeat;
        background-size:  contain;
    }
</style>
<script>
    function zoomImg(url) {
        document.getElementById('zoom').style.display = 'block';
        document.getElementById('zoom').style.backgroundImage = 'url(' + url + ')';
    }
    function zoomOff() {
        document.getElementById('zoom').style.display = 'none';
    }
</script>
<?php
require_once '../../../Libs/php/Conect.class.php';

function pegaFotos($tabela, $propriedade_id, $tp = '') {

    if ($tp === '') {
        $tabela === 'colaborador' ? $sql = "SELECT * FROM $tabela WHERE id_propriedade=$propriedade_id;" : $sql = "SELECT * FROM $tabela WHERE propriedade_id=$propriedade_id;";
    } else {
        $sql = "SELECT * FROM $tabela WHERE cod_propriedade=$propriedade_id;";
    }
    $db = new Conect;
    $array = $db->Sql($sql);

    $ListaImgs = '';

    for ($i = 0; $i < count($array); $i++) {
        echo "<img class='AlbumPropriedade' onclick='zoomImg(\"/Templates/imgs/spr_image.php?img=" . $_SERVER['HTTP_REFERER'] . $array[$i]->foto . "\");' src='/Templates/imgs/spr_image.php?img=" . $_SERVER['HTTP_REFERER'] . $array[$i]->foto . "'  />";
    }

    unset($db);
    echo $ListaImgs;
}
?>

<div class="Book">
    <label class="Title"><a name='fachada'>Fachada</a></label>
    <?php pegaFotos('prop_fachada', $_REQUEST['propriedade_id']) ?>
    <label class="Title"><a name='maqequip'>Marquinas e Equipamentos</a></label>
    <?php pegaFotos('prop_maqequip', $_REQUEST['propriedade_id']) ?>

    <label class="Title"><a name='marcaviveres'>Marca Viveres</a></label>
    <?php pegaFotos('prop_marcaviveres', $_REQUEST['propriedade_id']) ?>

    <label class="Title"><a name='pessoas' >Pessoas</a></label>
    <?php pegaFotos('colaborador', $_REQUEST['propriedade_id']) ?>

    <label class="Title"><a name='album'>Album da Propriedade</a></label>
    <?php pegaFotos('fotos', $_REQUEST['propriedade_id']) ?>

    <label class="Title"><a name='legado'>Fotos Legado</a></label>
    <?php pegaFotos('fotos', $_REQUEST['cod_propriedade'], 'legado') ?>
    <ul>
        <li><a href='#fachada'>Fachada</a></li>
        <li><a href='#maqequip'>Marquinas e Equipamentos</a></li>
        <li><a href='#marcaviveres'>Marca Viveres</a></li>
        <li><a href='#pessoas'>Pessoas</a></li>
        <li><a href='#album'>Album da Propriedade</a></li>
        <li><a href='#legado'>Fotos Legado</a></li>
    </ul>
</div>

<div id="zoom" onmouseout='zoomOff();' onmousedown="zoomOff()" >

</div>