<script type="text/javascript">
    var marker;
    var poligCity;

    function mudaOpmCrpm(idselect, idcrpm) {
        select = document.getElementById(idselect);
        PopulaSelect(select, 'Libs/php/JsonOpm.php?id=' + idcrpm);
        mudaCidadeCrpm('cidade', document.getElementById('opm').value);
    }

    function mudaCidadeCrpm(idselect) {
        idopm = document.getElementById('opm').value;

        select = document.getElementById(idselect);
        PopulaSelect(select, 'Libs/php/JsonCidade.php?id=' + idopm);
        mudaZonaRural('zonarural', document.getElementById('cidade').value);
        cidade2Mapa(document.getElementById('cidade').value);

    }

    function mudaZonaRural(idselect, id) {
        select = document.getElementById(idselect);
        PopulaSelect(select, 'Libs/php/JsonZonaRural.php?id=' + id);
        //cidade2Mapa(document.getElementById('cidade').value);
    }

    function mudaOpmMunicipio(idselect, id) {
        select = document.getElementById(idselect);
        PopulaSelect(select, 'Libs/php/JsonOpm4Municipio.php?id=' + id);
    }

    function setSelect(idselect, vl) {
        document.getElementById(idselect).value = vl;
    }

    function pegaPoligCidade(nomecidade) {
        //alert(nomecidade);
        var xmlhttpc = new XMLHttpRequest();
        xmlhttpc.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (poligCity) {
                    poligCity.remove();
                }
                poligCity = eval(this.responseText);
                poligCity.addTo(mymap);
            }
        };
        ncidade = removerAcentos(nomecidade);
        ncidade = ncidade.replace(/\s/g, '');

        xmlhttpc.open("GET", window.location.protocol + "//" + window.location.hostname + "/Libs/js/cidade-json/GO/" + ncidade + ".js", false);
        xmlhttpc.send();
    }

    function cidadeMapa(cidade) {
        geoObj = null;
        fetch(window.location.protocol + "//" + window.location.hostname + '/Libs/php/cidade4nome.php?nome=' + cidade)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    // Work with JSON data here
                    geoObj = data;
                    document.getElementById('lat').value = geoObj.latitude;
                    document.getElementById('log').value = geoObj.longitude;
                    marker = new L.marker([geoObj.latitude, geoObj.longitude], {draggable: true}).addTo(mymap)
                            .on('dragend', function (e) {
                                document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                                document.getElementById('log').value = e.target.getLatLng().lng.toString();
                            })
                            .bindPopup("Cidade: " + geoObj.nome).openPopup();
                    // mymap.setZoom(14);
                    mymap.panTo(new L.LatLng(geoObj.latitude, geoObj.longitude));
                    pegaPoligCidade(removerAcentos(geoObj.nome));
                })
                .catch(err => {
                    // Do something for an error here
                });
    }

    function cidade2Mapa(cidade) {

        geoObj = null;
        fetch(window.location.protocol + "//" + window.location.hostname + '/Libs/php/cidade4id.php?id=' + cidade)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    // Work with JSON data here

                    geoObj = data.obj[0];

                    if (document.getElementById('id').value === '') {
                        document.getElementById('lat').value = geoObj.latitude;
                        document.getElementById('log').value = geoObj.longitude;
                        if (marker) {
                            mymap.removeLayer(marker);
                        }

                        marker = new L.marker([geoObj.latitude, geoObj.longitude], {draggable: true}).addTo(mymap)
                                .on('dragend', function (e) {
                                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                                })
                                .bindPopup("Cidade: " + geoObj.nome).openPopup();
                        mymap.setZoom(12);
                        mymap.panTo(new L.LatLng(geoObj.latitude, geoObj.longitude));
                    }
                    pegaPoligCidade(removerAcentos(geoObj.nome));
                })
                .catch(err => {
                    // Do something for an error here
                });
    }

    function setaMarcadorPropriedade(lat, lng, nomeProp) {
        /* remove o marcador da cidade e seta o da propriedade! */

        if (marker) {
            mymap.removeLayer(marker);
        }

        var vtrIcon = L.icon({
            iconUrl: 'Templates/imgs/pin_blue.svg', iconSize: [35, 47]});

        marker = new L.marker([lat, lng], {Icon: vtrIcon, draggable: true}).addTo(mymap)
                .on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                })
                .bindPopup('Propriedade: ' + nomeProp).openPopup();
        // mymap.setZoom(14);
        mymap.panTo(new L.LatLng(lat, lng));
    }

    function addPropriedade(resultado) {
        if (resultado.isInteger) {
            document.getElementById('id').value = resultado;
            if (confirm("Deseja Cadastrar uma nova propriedade?")) {
                document.getElementById('resetar').click();
            }
        } else {
            alert(resultado);
        }
    }

    function reposicionaMarkerPropriedade(zoom = false, lat = false, lng = false) {
        /* remove o marcador da cidade e seta o da propriedade! */

        var vtrIcon = L.icon({
            iconUrl: 'Templates/imgs/pin_blue.svg', iconSize: [35, 47]});

        if (marker) {
            mymap.removeLayer(marker);
        }

        if (lat === false)
            lat = document.getElementById('lat').value;
        if (lng === false)
            lng = document.getElementById('log').value;

        nomeProp = document.getElementById('nome').value;

        marker = new L.marker([lat, lng], {Icon: vtrIcon, draggable: true}).addTo(mymap).on('dragend', function (e) {
            document.getElementById('lat').value = e.target.getLatLng().lat.toString();
            document.getElementById('log').value = e.target.getLatLng().lng.toString();
        }).bindPopup('Propriedade: ' + nomeProp).openPopup();
        if (zoom > 0) {
            mymap.setZoom(zoom);
        }
        mymap.panTo(new L.LatLng(lat, lng));
    }



    function ibgecod(nomecidade, lat, lon) {

        fetch(window.location.protocol + "//" + window.location.hostname + '/Libs/php/cidade4nome.php?nome=' + nomecidade)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    if (Object.keys(data.obj).length > 0) {
                        // Work with JSON data here
                        geoObj = data;
                        setSelect('crpm', data.obj[0].crpm_id);
                        mudaOpmCrpm('opm', data.obj[0].crpm_id);
                        setSelect('opm', data.obj[0].cod_opm);
                        mudaCidadeCrpm('cidade');
                        setSelect('cidade', (data.obj[0].codigo_ibge));
                        cidade2Mapa(data.obj[0].codigo_ibge);
                        document.getElementById('carregando').style.display = 'none';
                    }
                })
                .catch(err => {
                    // Do something for an error here
                    document.getElementById('carregando').style.display = 'none';
                    alert("Geo-referenciamento não confirmado!");
                });
        document.getElementById('carregando').style.display = 'none';
    }

    function pegaCidade(lat, lon) {

        document.getElementById('carregando').style.display = 'block';
        //https://nominatim.openstreetmap.org/reverse?lat=-15.93279&lon=-49.84476&format=json&zoom=10
        URL = 'https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lon + '&format=json&zoom=10';

        fetch(URL)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    // Work with JSON data here

                    if (data.address.town !== undefined) {//cidade
                        ibgecod(data.address.town, lat, lon);
                        return true;
                    }
                    if (data.address.city !== undefined) {//cidade
                        ibgecod(data.address.city, lat, lon);
                        return true;
                    }
                    if (data.address.municipality !== undefined) {//municipio
                        ibgecod(data.address.municipality, lat, lon);
                        return true;
                    }
                    if (data.address.village !== undefined) {//vila, vilarejo
                        ibgecod(data.address.village, lat, lon);
                        return true;
                    }
                    if (data.address.district !== undefined) {//distrito
                        ibgecod(data.address.district, lat, lon);
                        return true;
                    }
                    if (data.address.hamlet !== undefined) {//aldeia
                        ibgecod(data.address.hamlet, lat, lon);
                        return true;
                    }

                }
                )
                .catch(err => {
                    // Do something for an error here
                });
    }

    function posicionaMarkerProp() {
        icon = document.getElementById('tipoprop').value;
          
        if (isObject(marker)) {
            mymap.removeLayer(marker);
        }

        latitude = document.getElementById('lat').value;
        longitude = document.getElementById('log').value;
        nomeProp = document.getElementById('nome').value;
        
        switch (icon) {
             
            case '2':
                marker = L.marker([latitude, longitude], {icon: pin_green, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '3':
                marker = L.marker([latitude, longitude], {icon: pin_red, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '4':
                marker = L.marker([latitude, longitude], {icon: pin_yellow, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '5':
                marker = L.marker([latitude, longitude], {icon: pin_white, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '6':
                marker = L.marker([latitude, longitude], {icon: pin_lavender, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '7':
                marker = L.marker([latitude, longitude], {icon: pin_pink, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            case '9':
                marker = L.marker([latitude, longitude], {icon: pin_eleicao, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
            default:
                marker = L.marker([latitude, longitude], {icon: pin_blue, draggable: true,autoPan: true}).on('dragend', function (e) {
                    document.getElementById('lat').value = e.target.getLatLng().lat.toString();
                    document.getElementById('log').value = e.target.getLatLng().lng.toString();
                }).bindPopup("Propriedade: " + nomeProp);
                break;
        }
        
        marker.addTo(mymap);
        mymap.setView([latitude,longitude], 18);
        
    }

    function isObject(val) {
        return val instanceof Object;
    }
</script>

<?php
ini_set('display_errors', 'On');

require_once 'Propriedade.Class.php';
require_once '../../Libs/php/util.php';
require_once '../../Libs/php/Conect.class.php';

$Prop = new Propriedade;

if (isset($_REQUEST['id'])) {
    $Prop->setPropriedade($_REQUEST['id']);
}
$ut = new util;
$Db = new Conect();
/*
 * 1 Azul - Propriedades Cadastradas;
 * 2 Verde - Unidades de ensino;
 * 3 Vermelho - Postos de combustível;
 * 4 Amarelo - Povoados;
 * 5 Branco - Distritos;
 * 6 Lilás - Correspondentes bancários, loterias e Caixas de auto-atendimento;
 * 7 Rosa - Câmeras [objeto não é local]
 * 8 Marrom - Viaturas e Base;
 * 9 icone - Urnas eleitorais;
 *  
 */
?>

<label class="TituloForm">Cadastro de propriedade </label>
<div class="col col-2" >
    <form action="Modulos/Propriedade/ctrl_propriedade.php" method="POST" enctype="Multipart/form-data" id='frm_propriedade' onsubmit="return false;"  >
        <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>" />
        <input type="hidden" id="cod_propriedade" name="cod_propriedade" value="<?php echo $Prop->getCod_propriedade(); ?>" />
        <div class="col col-2">
            <span>
                <label for="tipoprop">Tipo</label>
                <select id="tipoprop" name="tipoprop" onchange="posicionaMarkerProp()" required>
                    <option>Informe o tipo de propriedade</option>
                    <option <?php if($Prop->getTipoprop()==1) echo 'selected';?> value=1>Propriedades Rural</option>
                    <option <?php if($Prop->getTipoprop()==2) echo 'selected';?> value=2>Unidades de ensino</option>
                    <option <?php if($Prop->getTipoprop()==3) echo 'selected';?> value=3>Postos de combustível</option>
                    <option <?php if($Prop->getTipoprop()==4) echo 'selected';?> value=4>Povoados</option>
                    <option <?php if($Prop->getTipoprop()==5) echo 'selected';?> value=5>Disritos</option>
                    <option <?php if($Prop->getTipoprop()==6) echo 'selected';?> value=6>Correspondentes bancários, loterias e Caixas de auto-atendimento</option>
                    <option <?php if($Prop->getTipoprop()==7) echo 'selected';?> value=7>Câmeras</option>
                    <option <?php if($Prop->getTipoprop()==8) echo 'selected';?> value=8>Base de Policial</option>
                    <option <?php if($Prop->getTipoprop()==9) echo 'selected';?> value=9>Urnas Eleitorais</option>
                </select>
            </span>
            <span><label for="crpm">CRPM</label><select id="crpm" name="crpm" onchange="mudaOpmCrpm('opm', this.value);">
                    <?php echo $ut->populaSelect('sigla', 'id', 'view_crpm', null, 'id', $Prop->getCrpm_id()) ?></select></span>
            <span><label for="opm">OPM</label><select id="opm" name="opm" onchange="mudaCidadeCrpm('cidade', this.value)" >
                    <?php
                    echo $ut->populaSelect('sigla', 'id', 'view_opm', 'id_superior=' . $Prop->getCrpm_id(), 'id', $Prop->getOpm_id());
                    ?>
                </select></span>
            <span><label for="cidade">Cidade</label><select id="cidade" name="cidade"  onchange="mudaZonaRural('zonarural', this.value);cidade2Mapa(this.value);" >
                    <?php
                    echo $ut->populaSelect('nome', 'codigo_ibge', 'view_cidades_opm', 'id_opm=' . $Prop->getOpm_id(), 'nome', $Prop->getId_cidade());
                    ?>

                </select></span>
            <span><label for="zonarural">Zona Rural</label><select id="zonarural" name="zonarural"><option>Escolha a Zona Rural!</option></select></span>
            <span>
                <label>Atividade Rural</label>
                <div class="multiselect">
                    <label  for="multiselect">Selecione as Atividades: <a id="qtd_atv">0</a> escolhidas</label>
                    <input type="checkbox" id="multiselect" name="multiselect" />
                    <span class="opcoes">
                        <?php
                        $ATVs = $Db->Sql("SELECT id,nome_atividade FROM public.atividaderural");

                        while ($atv = current($ATVs)) {
                            if ($atv->nome_atividade !== 'error') {
                                echo "<p><label for=\"atividaderural\">{$atv->nome_atividade}</label><input type=\"checkbox\" onchange='qtdselect(this)' id=\"id_atividade[]\" name=\"id_atividade[]\" value=\"{$atv->id}\" /><p>";
                            }
                            next($ATVs);
                        }
                        ?>
                    </span>
                </div>
            </span>
            <span><label for="nome">Nome da Propriedade</label><input type="text" id="nome" name="nome"  value="<?php echo $Prop->getNome(); ?>" required /></span>
            <span><label for="numero">Número da Propriedade</label><input type="text" id="numero" name="numero" value="<?php echo $Prop->getNr_propriedade(); ?>" /></span>
        </div>
        <div class="col col-2">
            <span><label for="referencia">Referência</label><input type="text" id="referencia" name="referencia" value="<?php echo $Prop->getReferencia(); ?>" /></span>
            <span><label for="referencia">Latitude</label><input type="text" id="lat" name="lat" value="<?php echo $Prop->getLat(); ?>" required onchange="posicionaMarkerProp()" /> </span>
            <span><label for="referencia">Longitude</label><input type="text" id="log" name="log" value="<?php echo $Prop->getLog(); ?>" required onchange="posicionaMarkerProp()" /></span>
            <span><label for="rede">Nome da Rede Wifi</label><input type="text" id="rede" name="rede" value="<?php echo $Prop->getRedewifi(); ?>" /></span>
            <span><label for="senha">Senha da Rede Wifi</label><input type="text" id="senha" name="senha" value="<?php echo $Prop->getSenhawifi(); ?>" /></span>
            <span><label for="defencivo">Usa Defencivo agricola?</label><input type="radio" id="defensivo" name="defensivo" value="true" />Sim<input type="radio" id="defensivo" name="defensivo" value="false" />Não</span>
            <span><label for="mes_ini">Mês de Início</label><input type="text" id="mes_ini" name="def_mes_ini" value="<?php echo $Prop->getDef_mes_ini(); ?>" /></span>
            <span><label for="Mes_fin">Mes de Termino</label><input type="text" id="Mes_fin" name="def_mes_fim" value="<?php echo $Prop->getDef_mes_ini(); ?>" /></span>
        </div>
    </form>
</div>

<script type="text/javascript">
    if ((document.getElementById('id').value > 0)) {
        document.getElementById('acao').value = "Alterar";
        pegaCidade(document.getElementById('lat').value, document.getElementById('log').value);
    } else {
        document.getElementById('acao').value = "Incluir";
    }
</script>
<br>
<div class="col col-2">
    <div id="mapid" ></div>
</div>
<div class="col-1">
    <div class="tolllinks">
        <a class="abuttom" onclick="callFormDetail('Cadastrar Maquinas e Equipamentos', Base_URL + '/Modulos/Propriedade/Hardware/formMaquinarios.php?propriedade_id=' + document.getElementById('id').value, 'detailBody')" >Cadastrar Maquinas e Equipamentos</a>
        <a class="abuttom" onclick="callFormDetail('Cadastrar Marca do gado', Base_URL + '/Modulos/Propriedade/Viveres/FormViveres.php?propriedade_id=' + document.getElementById('id').value, 'detailBody')" >Cadastrar Marca do gado</a>
        <a class="abuttom" onclick="callFormDetail('Cadastrar Pessoas', Base_URL + '/Modulos/Propriedade/Colaborador/formColaboradores.php?id_propriedade=' + document.getElementById('id').value, 'detailBody')">Cadastrar Pessoas</a>
        <a class="abuttom" onclick="callFormDetail('Cadastrar Fachada', Base_URL + '/Modulos/Propriedade/Fachada/formFachada.php?propriedade_id=' + document.getElementById('id').value, 'detailBody')">Cadastrar Fachada</a>
        <a class="abuttom" onclick="callFormDetail('Outras Fotos', Base_URL + '/Modulos/Propriedade/FotoBook/BookPropriedade.php?cod_propriedade=' + document.getElementById('cod_propriedade').value + '&propriedade_id=' + document.getElementById('id').value, 'detailBody')">Outras Fotos</a>
    </div>
    <div class="tollbar">
        <input type="submit" id="acao" name="acao" value="Incluir" onclick="ObjProcAjax.runPost('Modulos/Propriedade/ctrl_propriedade.php', null, 'frm_propriedade', 'addPropriedade');" />
        <input type="reset" value="Cancelar" />
    </div>
</div>
<script>

<?php
if (isset($_REQUEST['id']) and is_numeric($_REQUEST['id'])) {
    
}
?>

    var marker = null;

    var mbAttr = 'Map data &copy OpenStreetMap contributors, CC-BY-SA, Imagery © Mapbox';
    var mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    var streets_satellite = L.tileLayer(mbUrl, {id: 'mapbox.streets-satellite', attribution: mbAttr});
    var mymap = L.map('mapid', {center: [-14.861577, -40.844505],
        zoom: 9,
        layers: [streets_satellite]});
    var LeafIcon = L.Icon.extend({options: {iconSize: [38, 95]}});

    var pin_blue = new LeafIcon({iconUrl: '../Templates/imgs/pin_blue.svg'}),
            pin_green = new LeafIcon({iconUrl: '../Templates/imgs/pin_green.svg'}),
            pin_red = new LeafIcon({iconUrl: '../Templates/imgs/pin_red.svg'}),
            pin_yellow = new LeafIcon({iconUrl: '../Templates/imgs/pin_yellow.svg'}),
            pin_white = new LeafIcon({iconUrl: '../Templates/imgs/pin_white.svg'}),
            pin_lavender = new LeafIcon({iconUrl: '../Templates/imgs/pin_lavender.svg'}),
            pin_pink = new LeafIcon({iconUrl: '../Templates/imgs/pin_pink.svg'}),
            pin_eleicao = new LeafIcon({iconUrl: '../Templates/imgs/pin_eleicao.svg'});
    //https://servicodados.ibge.gov.br/api/v2/malhas/52/?formato=application/vnd.geo+json

    var geojsonLayer = L.geoJSON({"type": "Polygon", "coordinates": [[[-41.361844400000003, -15.4942513], [-41.329992699999998, -15.7415597], [-40.704575800000001, -15.6663988], [-40.561329100000002, -15.802973400000001], [-40.231000000000002, -15.803000000000001], [-39.8580325, -16.110073799999999], [-40.157947399999998, -16.579363699999998], [-40.2835824, -16.586744100000001], [-40.280999999999999, -16.901], [-40.484313399999998, -16.877266200000001], [-40.5708512, -17.0621008], [-40.622999999999998, -17.405999999999999], [-40.219773000000004, -17.737603799999999], [-40.222818500000002, -17.979559399999999], [-39.471719499999999, -18.3679138], [-39.352876999999999, -18.108916499999999], [-38.670527800000002, -18.168547499999999], [-38.5113451, -18.0584536], [-38.929333300000003, -16.807753699999999], [-38.646967199999999, -15.883265700000001], [-38.853373499999996, -14.6550765], [-38.617609399999999, -13.288688199999999], [-37.896681899999997, -12.758442499999999], [-37.188891499999997, -11.566876499999999], [-37.345636399999997, -11.443058000000001], [-37.812182900000003, -11.516851900000001], [-38.228066499999997, -10.914186600000001], [-38.209194099999998, -10.7118758], [-37.814, -10.691000000000001], [-37.858882399999999, -10.427441399999999], [-37.734468999999997, -10.3329437], [-37.827808400000002, -10.00334], [-37.997, -9.9160000000000004], [-38.001448400000001, -9.4941174999999998], [-38.204447100000003, -9.4177166999999997], [-38.297412000000001, -9.0132978999999995], [-38.472948700000003, -9.0200458000000001], [-38.5076356, -8.8282025999999991], [-38.647331000000001, -8.9880093999999993], [-38.793414800000001, -8.7838098000000002], [-39.403877999999999, -8.5293793999999998], [-39.891611900000001, -8.8272609000000006], [-39.960302300000002, -9.0500802999999994], [-40.257342999999999, -9.0648090000000003], [-40.340339299999997, -9.3557185999999994], [-40.619372900000002, -9.4763587999999999], [-40.775841900000003, -9.4484343000000006], [-40.667000000000002, -9.1590000000000007], [-41.113709700000001, -8.7037972000000003], [-41.381, -8.7070000000000007], [-41.838000000000001, -9.2420000000000009], [-42.316777299999998, -9.3164038999999992], [-42.771477599999997, -9.6196622999999999], [-42.975005000000003, -9.4058028], [-43.280005199999998, -9.4242149000000008], [-43.4723702, -9.2607563000000006], [-43.851280299999999, -9.5500138000000003], [-43.661864999999999, -10.008967999999999], [-44.131, -10.634], [-44.332999999999998, -10.548], [-44.576999999999998, -10.625999999999999], [-44.9314575, -10.9280562], [-45.247999999999998, -10.821999999999999], [-45.604999999999997, -10.108000000000001], [-45.8452178, -10.4875978], [-46.207015300000002, -10.6589431], [-46.616999999999997, -11.289], [-46.479091099999998, -11.516339200000001], [-46.082999999999998, -11.635999999999999], [-46.313569899999997, -11.629372200000001], [-46.373243500000001, -11.872006300000001], [-46.171040300000001, -11.900795799999999], [-46.397315599999999, -12.036638999999999], [-46.351999999999997, -12.337], [-46.152999999999999, -12.483000000000001], [-46.286191299999999, -12.583926699999999], [-46.304598200000001, -12.949406099999999], [-46.111854700000002, -12.925993999999999], [-46.277344200000002, -13.012530699999999], [-46.331130700000003, -13.250501399999999], [-46.279267500000003, -13.347395000000001], [-46.040891899999998, -13.277838600000001], [-46.2439076, -13.432743], [-46.162054900000001, -13.592107199999999], [-46.284595299999999, -13.7408745], [-46.265000000000001, -14.098000000000001], [-45.906632799999997, -14.354970099999999], [-46.0168824, -14.4184052], [-45.965961200000002, -14.9752954], [-46.077240500000002, -15.264386699999999], [-44.214854600000002, -14.231821099999999], [-43.777256100000002, -14.3377397], [-43.859907999999997, -14.6751974], [-43.530318600000001, -14.8165151], [-43.248099199999999, -14.656780599999999], [-42.939187500000003, -14.7077174], [-42.354999999999997, -15.098000000000001], [-42.087658599999997, -15.186972600000001], [-41.801819199999997, -15.1002539], [-41.361844400000003, -15.4942513]]]}, {"fillOpacity": "0"}).addTo(mymap);
    var geojvtcom = L.geoJSON({"type": "Polygon", "coordinates": [[[-40.5255, -14.7563], [-40.6688, -14.8281], [-40.6834, -14.8381], [-40.7183, -14.8834], [-40.7237, -14.8967], [-40.7133, -14.9372], [-40.7238, -14.9726], [-40.7397, -14.9987], [-40.7114, -15.0137], [-40.7012, -15.0266], [-40.7112, -15.0382], [-40.7027, -15.0757], [-40.8198, -15.2026], [-40.8475, -15.2694], [-40.8169, -15.2852], [-40.8203, -15.304], [-40.8354, -15.2975], [-40.8812, -15.2934], [-40.8855, -15.2977], [-40.9063, -15.3093], [-40.9061, -15.3203], [-40.9326, -15.3371], [-40.9413, -15.3596], [-40.9268, -15.3908], [-40.9354, -15.4442], [-40.9753, -15.4758], [-41.0025, -15.4783], [-41.0343, -15.4727], [-41.0567, -15.4597], [-41.0788, -15.4593], [-41.0973, -15.4221], [-41.1398, -15.4021], [-41.1427, -15.3849], [-41.1332, -15.3718], [-41.1448, -15.3451], [-41.1448, -15.3043], [-41.1584, -15.3101], [-41.1581, -15.2632], [-41.1478, -15.232], [-41.1639, -15.1996], [-41.161, -15.1885], [-41.1288, -15.1662], [-41.1161, -15.132], [-41.0938, -15.1141], [-41.088, -15.042], [-41.1269, -14.9914], [-41.1261, -14.9765], [-41.1398, -14.9638], [-41.1359, -14.9339], [-41.1515, -14.9062], [-41.1423, -14.8824], [-41.1529, -14.8619], [-41.1697, -14.8624], [-41.1759, -14.8338], [-41.1623, -14.8267], [-41.1662, -14.8084], [-41.1005, -14.7942], [-41.0585, -14.8357], [-41.0298, -14.8211], [-41.0252, -14.8106], [-41.0062, -14.8191], [-40.9759, -14.8034], [-40.9634, -14.7898], [-40.9635, -14.6725], [-40.9589, -14.6447], [-40.9758, -14.6256], [-40.9756, -14.5996], [-40.942, -14.5894], [-40.9292, -14.5729], [-40.9063, -14.5754], [-40.8934, -14.5578], [-40.7832, -14.563], [-40.7567, -14.5842], [-40.6467, -14.5469], [-40.6368, -14.5783], [-40.6412, -14.6084], [-40.6331, -14.6588], [-40.6146, -14.6709], [-40.5255, -14.7563]]]}, {"fillOpacity": "0"}).addTo(mymap);

<?php
if (isset($_REQUEST['id']) and is_numeric($_REQUEST['id'])) {
    echo "posicionaMarkerProp();";
}
?>
</script>
<div id="formDetail">
    <title id="titDetail">Título<img src='/Templates/imgs/close.svg' /></title>
    <div id="detailBody"></div>
</div>

<div id="carregando">
    <div id="loading"></div>
</div>

<style>
    .col-2{height: calc(100% - 8em);} 
</style>