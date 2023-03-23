<style>
    #frm_Monitoramento span{float: left;}
    #mapid{
        border:1px solid darkgray
            ;
        height: 500px;
    }
    #propriedade{
        border: 1px dotted #E3F2E1;
        float: right;
        position:relative;
        margin-left:0.3em;
        width: 20em;
        top: 0em;
        overflow: auto;
        height: 4em;
        box-shadow: 5px 5px 8px;
        visibility: hidden;
    }
</style>
<script>
    function mostraListaProp() {
        if (document.getElementById('tbLsProp').innerHTML !== '') {
            document.getElementById('propriedade').style.visibility = 'visible'
        }
    }


    function addMarkerMap(lat, long,id) {

        var features = [];

        mymap.eachLayer(function (layer) {
            if (layer instanceof L.Marker) {

                if (mymap.getBounds().contains(layer.getLatLng())) {
                    mymap.removeLayer(layer);
                }
            }
        });
        var marker = new L.marker(L.latLng(lat, long)).addTo(mymap);
        mymap.setView(new L.LatLng(lat, long), 11);
        document.getElementById('id_propriedade').value=id
    }
    
    function addMoniotramento(){
        alert('Monitoramento registrado!');
        ObjProcAjax.run(Base_URL + '/Modulos/Produtividade/formMonitoramento.php', 'Corpo');
    }

</script>
<label class="TituloForm">Cadastro de Monitoramento</label>
<?php
require_once '../../Libs/php/util.php';
$ut = new util();
?>

<div class="col" >
    <form id='frm_Monitoramento' action="Modulos/Produtividade/ctrl_produtividade.php" method="POST" enctype="Multipart/form-data"  onsubmit="return false;"  >
        <input type="hidden" id="id_propriedade" name="id_propriedade" />
        <div class="col col-2">
            <span>
                <label for="pref_vrt">Prefixo da Viatrua</label>
                <input type="text" id="pref_vtr" name="pref_vtr"/>
            </span>
            <span>
                <label for="data">Data do Fato</label>
                <input type="text" id="data" name="data" value="<?php echo date('d/m/Y') ?>" />
            </span>
            <span>
                <label for="crpm">CRPM</label>
                <select id="crpm" name="crpm" onchange="mudaOpmCrpm('opm', this.value);"><?php echo $ut->populaSelect('sigla', 'id', 'view_crpm', null, 'id') ?></select>
            </span>
            <span>
                <label for="opm">OPM</label>
                <select id="opm" name="opm" onchange="mudaCidadeCrpm('cidade', this.value)" ><option>Escolha o CRPM!</option></select>
            </span>
            <span>
                <label for="cidade">Cidade</label>
                <select id="cidade" name="cidade"  onchange="mudaZonaRural('zonarural', this.value);
                        cidade2Mapa(this.value);" ><option>Escolha a OPM!</option>
                </select>
            </span>
            <span>
                <label for="nr_propriedade">Número da Propriedade</label><input type="text" id="nr_propriedade" name="nr_propriedade" onkeyup="addLstProp('tbLsProp', '/Modulos/Produtividade/buscaPropriedade.php?busca=' + this.value, '/Templates/imgs/iconToMap.svg');mostraListaProp()" />
                <div id="propriedade">
                    <table id="tbLsProp"></table>
                </div>
            </span>
            <div class="col col-1">
                <span>
                    <label for="Obs">Observações</label>
                    <textarea id="obs" name="obs" cols="60" ></textarea>
                </span>
            </div>
        </div>
        <div class="col col-2">
            <div id="mapid" ></div>
        </div>
        
    </form>
</div>
<div class="col-1">
    <div class="tollbar">
        <input type="submit" id="acao" name="acao" value="Incluir" onclick="ObjProcAjax.runPost('Modulos/Produtividade/ctrl_produtividade.php', null, 'frm_Monitoramento', 'addMoniotramento');" />
        <input type="reset" value="Cancelar" />
    </div>
</div>
<script>
    var mbAttr = 'Map data &copy OpenStreetMap contributors, CC-BY-SA, Imagery © Mapbox'
    var mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    var grayscale = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr}),
            streets = L.tileLayer(mbUrl, {id: 'mapbox.streets', attribution: mbAttr}),
            dark = L.tileLayer(mbUrl, {id: 'mapbox.dark', attribution: mbAttr}),
            satellite = L.tileLayer(mbUrl, {id: 'mapbox.satellite', attribution: mbAttr}),
            streets_satellite = L.tileLayer(mbUrl, {id: 'mapbox.streets-satellite', attribution: mbAttr}),
            streets_basic = L.tileLayer(mbUrl, {id: 'mapbox.streets-basic', attribution: mbAttr}),
            comic = L.tileLayer(mbUrl, {id: 'mapbox.comic', attribution: mbAttr}),
            outdoors = L.tileLayer(mbUrl, {id: 'mapbox.outdoors', attribution: mbAttr}),
            run_bike_hike = L.tileLayer(mbUrl, {id: 'mapbox.run-bike-hike', attribution: mbAttr}),
            pencil = L.tileLayer(mbUrl, {id: 'mapbox.pencil', attribution: mbAttr}),
            pirates = L.tileLayer(mbUrl, {id: 'mapbox.pirates', attribution: mbAttr}),
            emerald = L.tileLayer(mbUrl, {id: 'mapbox.emerald', attribution: mbAttr}),
            high_contrast = L.tileLayer(mbUrl, {id: 'mapbox.high-contrast', attribution: mbAttr});
    var mymap = L.map('mapid', {
        center: [-14.861577, -40.844505],
        zoom: 11,
        layers: [streets_satellite]
    });
    //https://servicodados.ibge.gov.br/api/v2/malhas/52/?formato=application/vnd.geo+json
    var geojsonLayer = L.geoJSON({"type": "Polygon", "coordinates": [[[-41.361844400000003, -15.4942513], [-41.329992699999998, -15.7415597], [-40.704575800000001, -15.6663988], [-40.561329100000002, -15.802973400000001], [-40.231000000000002, -15.803000000000001], [-39.8580325, -16.110073799999999], [-40.157947399999998, -16.579363699999998], [-40.2835824, -16.586744100000001], [-40.280999999999999, -16.901], [-40.484313399999998, -16.877266200000001], [-40.5708512, -17.0621008], [-40.622999999999998, -17.405999999999999], [-40.219773000000004, -17.737603799999999], [-40.222818500000002, -17.979559399999999], [-39.471719499999999, -18.3679138], [-39.352876999999999, -18.108916499999999], [-38.670527800000002, -18.168547499999999], [-38.5113451, -18.0584536], [-38.929333300000003, -16.807753699999999], [-38.646967199999999, -15.883265700000001], [-38.853373499999996, -14.6550765], [-38.617609399999999, -13.288688199999999], [-37.896681899999997, -12.758442499999999], [-37.188891499999997, -11.566876499999999], [-37.345636399999997, -11.443058000000001], [-37.812182900000003, -11.516851900000001], [-38.228066499999997, -10.914186600000001], [-38.209194099999998, -10.7118758], [-37.814, -10.691000000000001], [-37.858882399999999, -10.427441399999999], [-37.734468999999997, -10.3329437], [-37.827808400000002, -10.00334], [-37.997, -9.9160000000000004], [-38.001448400000001, -9.4941174999999998], [-38.204447100000003, -9.4177166999999997], [-38.297412000000001, -9.0132978999999995], [-38.472948700000003, -9.0200458000000001], [-38.5076356, -8.8282025999999991], [-38.647331000000001, -8.9880093999999993], [-38.793414800000001, -8.7838098000000002], [-39.403877999999999, -8.5293793999999998], [-39.891611900000001, -8.8272609000000006], [-39.960302300000002, -9.0500802999999994], [-40.257342999999999, -9.0648090000000003], [-40.340339299999997, -9.3557185999999994], [-40.619372900000002, -9.4763587999999999], [-40.775841900000003, -9.4484343000000006], [-40.667000000000002, -9.1590000000000007], [-41.113709700000001, -8.7037972000000003], [-41.381, -8.7070000000000007], [-41.838000000000001, -9.2420000000000009], [-42.316777299999998, -9.3164038999999992], [-42.771477599999997, -9.6196622999999999], [-42.975005000000003, -9.4058028], [-43.280005199999998, -9.4242149000000008], [-43.4723702, -9.2607563000000006], [-43.851280299999999, -9.5500138000000003], [-43.661864999999999, -10.008967999999999], [-44.131, -10.634], [-44.332999999999998, -10.548], [-44.576999999999998, -10.625999999999999], [-44.9314575, -10.9280562], [-45.247999999999998, -10.821999999999999], [-45.604999999999997, -10.108000000000001], [-45.8452178, -10.4875978], [-46.207015300000002, -10.6589431], [-46.616999999999997, -11.289], [-46.479091099999998, -11.516339200000001], [-46.082999999999998, -11.635999999999999], [-46.313569899999997, -11.629372200000001], [-46.373243500000001, -11.872006300000001], [-46.171040300000001, -11.900795799999999], [-46.397315599999999, -12.036638999999999], [-46.351999999999997, -12.337], [-46.152999999999999, -12.483000000000001], [-46.286191299999999, -12.583926699999999], [-46.304598200000001, -12.949406099999999], [-46.111854700000002, -12.925993999999999], [-46.277344200000002, -13.012530699999999], [-46.331130700000003, -13.250501399999999], [-46.279267500000003, -13.347395000000001], [-46.040891899999998, -13.277838600000001], [-46.2439076, -13.432743], [-46.162054900000001, -13.592107199999999], [-46.284595299999999, -13.7408745], [-46.265000000000001, -14.098000000000001], [-45.906632799999997, -14.354970099999999], [-46.0168824, -14.4184052], [-45.965961200000002, -14.9752954], [-46.077240500000002, -15.264386699999999], [-44.214854600000002, -14.231821099999999], [-43.777256100000002, -14.3377397], [-43.859907999999997, -14.6751974], [-43.530318600000001, -14.8165151], [-43.248099199999999, -14.656780599999999], [-42.939187500000003, -14.7077174], [-42.354999999999997, -15.098000000000001], [-42.087658599999997, -15.186972600000001], [-41.801819199999997, -15.1002539], [-41.361844400000003, -15.4942513]]]}, {"fillOpacity": "0"}).addTo(mymap);
    var geojvtcom    = L.geoJSON({"type": "Polygon", "coordinates": [[[-40.5255, -14.7563], [-40.6688, -14.8281], [-40.6834, -14.8381], [-40.7183, -14.8834], [-40.7237, -14.8967], [-40.7133, -14.9372], [-40.7238, -14.9726], [-40.7397, -14.9987], [-40.7114, -15.0137], [-40.7012, -15.0266], [-40.7112, -15.0382], [-40.7027, -15.0757], [-40.8198, -15.2026], [-40.8475, -15.2694], [-40.8169, -15.2852], [-40.8203, -15.304], [-40.8354, -15.2975], [-40.8812, -15.2934], [-40.8855, -15.2977], [-40.9063, -15.3093], [-40.9061, -15.3203], [-40.9326, -15.3371], [-40.9413, -15.3596], [-40.9268, -15.3908], [-40.9354, -15.4442], [-40.9753, -15.4758], [-41.0025, -15.4783], [-41.0343, -15.4727], [-41.0567, -15.4597], [-41.0788, -15.4593], [-41.0973, -15.4221], [-41.1398, -15.4021], [-41.1427, -15.3849], [-41.1332, -15.3718], [-41.1448, -15.3451], [-41.1448, -15.3043], [-41.1584, -15.3101], [-41.1581, -15.2632], [-41.1478, -15.232], [-41.1639, -15.1996], [-41.161, -15.1885], [-41.1288, -15.1662], [-41.1161, -15.132], [-41.0938, -15.1141], [-41.088, -15.042], [-41.1269, -14.9914], [-41.1261, -14.9765], [-41.1398, -14.9638], [-41.1359, -14.9339], [-41.1515, -14.9062], [-41.1423, -14.8824], [-41.1529, -14.8619], [-41.1697, -14.8624], [-41.1759, -14.8338], [-41.1623, -14.8267], [-41.1662, -14.8084], [-41.1005, -14.7942], [-41.0585, -14.8357], [-41.0298, -14.8211], [-41.0252, -14.8106], [-41.0062, -14.8191], [-40.9759, -14.8034], [-40.9634, -14.7898], [-40.9635, -14.6725], [-40.9589, -14.6447], [-40.9758, -14.6256], [-40.9756, -14.5996], [-40.942, -14.5894], [-40.9292, -14.5729], [-40.9063, -14.5754], [-40.8934, -14.5578], [-40.7832, -14.563], [-40.7567, -14.5842], [-40.6467, -14.5469], [-40.6368, -14.5783], [-40.6412, -14.6084], [-40.6331, -14.6588], [-40.6146, -14.6709], [-40.5255, -14.7563]]]}, {"fillOpacity": "0"}).addTo(mymap);
</script>