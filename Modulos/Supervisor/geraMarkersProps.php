<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

echo"var propIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_blue.svg',
        iconSize: [30, 47]});
     var ensIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_green.svg',
        iconSize: [30, 47]});
     var combIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_white.svg',
        iconSize: [30, 47]});
     var povIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_yellow.svg',
        iconSize: [30, 47]});
     var distIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_red.svg',
        iconSize: [30, 47]});
     var finIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_lavender.svg',
        iconSize: [30, 47]});
     var camIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_pink.svg',
        iconSize: [30, 47]});
    var corpoIcon = L.icon({
        iconUrl: 'Templates/imgs/icon_cruz.svg',
        iconSize: [30, 47]});
     var pmIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_brown.svg',
        iconSize: [30, 47]});
     var ubsIcon = L.icon({
        iconUrl: 'Templates/imgs/icon_ubs.svg',
        iconSize: [30, 47]});
     var pm77Icon = L.icon({
        iconUrl: 'Templates/imgs/icon_77cipm.svg',
        iconSize: [30, 47]});
     var pm78Icon = L.icon({
        iconUrl: 'Templates/imgs/icon_78cipm.svg',
        iconSize: [30, 47]});
     var festasIcon = L.icon({
        iconUrl: 'Templates/imgs/fogueira.svg',
        iconSize: [30, 47]});
     var treIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_eleicao.svg',
        iconSize: [30, 47]});
     var urnas2pelIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_eleicao_verde.svg',
        iconSize: [30, 47]});
     var urnas3pelIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_eleicao_amarelo.svg',
        iconSize: [30, 47]});
     var urnas4pelIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_eleicao_vermelho.svg',
        iconSize: [30, 47]});
     var maracasIcon = L.icon({
        iconUrl: 'Templates/imgs/pin_red.svg',
        iconSize: [30, 47]});
     
        
    var propriedades = L.layerGroup();
    var ensino = L.layerGroup();
    var ubs = L.layerGroup();
    var postos = L.layerGroup();
    var povoados = L.layerGroup();
    var distritos = L.layerGroup();
    var finac = L.layerGroup();
    var corpo2020 = L.layerGroup();
    var corpo2021 = L.layerGroup();
    var corpo2022 = L.layerGroup();
    var corpo2023 = L.layerGroup();
    var cameras = L.layerGroup();
    var vtrbs = L.layerGroup();
    var vtrbs77 = L.layerGroup();
    var vtrbs78 = L.layerGroup();    
    var urnas2pel = L.layerGroup();
    var urnas3pel = L.layerGroup();
    var urnas4pel = L.layerGroup();
    var cerco92 = L.layerGroup();
    var festas = L.layerGroup();
    var undtre = L.layerGroup();
    var extra = L.layerGroup()";
    

require_once '../../Libs/php/Conect.class.php';

$con = new Conect();
$results = $con->Sql("select lat,log, nome,tipoprop from propriedade;");

/*
  L.marker([-16.664038, -49.285693], {icon: vtrIcon}).bindPopup('PREFIXO:10.926 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.664048, -49.285601], {icon: vtrIcon}).bindPopup('PREFIXO:10.927 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.664053, -49.285478], {icon: vtrIcon}).bindPopup('PREFIXO:10.937 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.664074, -49.285344], {icon: vtrIcon}).bindPopup('PREFIXO:10.554 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.663935, -49.28565], {icon: vtrIcon}).bindPopup('PREFIXO:11.017 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.66395, -49.285516], {icon: vtrIcon}).bindPopup('PREFIXO:10.200 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.663955, -49.285398], {icon: vtrIcon}).bindPopup('PREFIXO:10.928 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural),
  L.marker([-16.663971, -49.285258], {icon: vtrIcon}).bindPopup('PREFIXO:10.938 #COMANDANTE:  #FUNCIONAL VTR:').addTo(viaturas_rural);

  1 Azul - Propriedades Cadastradas;
  2 Verde - Unidades de ensino;
  3 Vermelho - Postos de combustível;
  4 Amarelo - Povoados;
  5 Branco - Distritos;
  6 Lilás - Correspondentes bancários, loterias e Caixas de auto-atendimento;
  7 Rosa - Câmeras [objeto não é local]
  8 Marrom - Viaturas e Base;
  9 icone - Urnas eleitorais;
 */


while ($row = current($results)) {
    $row->lat = str_replace(",", ".", $row->lat);
    $row->log = str_replace(",", ".", $row->log);
    echo "\n";
    switch ($row->tipoprop) {
        case 1:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: propIcon}).bindPopup('Propriedade :{$row->nome}').addTo(propriedades)";
            break;
        case 2:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: ensIcon}).bindPopup('Escola :{$row->nome}').addTo(ensino)";
            break;
        case 3:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: combIcon}).bindPopup('Posto de Combustível :{$row->nome}').addTo(postos)";
            break;
        case 4:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: povIcon}).bindPopup('Quilombo :{$row->nome}').addTo(povoados)";
            break;
        case 5:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: distIcon}).bindPopup('Distrito :{$row->nome}').addTo(distritos)";
            break;
        case 6:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: finIcon}).bindPopup('Estabelecimento Financeiro :{$row->nome}').addTo(finac)";
            break;
        case 7:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: camIcon}).bindPopup('Câmera :{$row->nome}').addTo(cameras)";
            break;
        case 8:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: pmIcon}).bindPopup('OPM/Vtr :{$row->nome}').addTo(vtrbs)";
            break;
        case 9:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: treIcon}).bindPopup('Urna 1º Pelotão :{$row->nome}').addTo(undtre)";
            break;
        case 10:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: urnas2pelIcon}).bindPopup('Urna 2º Pelotão :{$row->nome}').addTo(urnas2pel)";
            break;
        case 11:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: urnas3pelIcon}).bindPopup('Urna 3º Pelotão :{$row->nome}').addTo(urnas3pel)";
            break;
        case 12:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: urnas4pelIcon}).bindPopup('Urna 4º Pelotão :{$row->nome}').addTo(urnas4pel)";
            break;
        case 13:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: maracasIcon}).bindPopup('Centro Industrial :{$row->nome}').addTo(cerco92)";
            break;
        case 14:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: pm77Icon}).bindPopup('Bases na Área da 77CIPM :{$row->nome}').addTo(vtrbs77)";
            break;
        case 15:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: pm78Icon}).bindPopup('Bases na Área da 78CIPM :{$row->nome}').addTo(vtrbs78)";
            break;
        case 16:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: ubsIcon}).bindPopup('Unidades de Saúde :{$row->nome}').addTo(ubs)";
            break;
        case 17:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: festasIcon}).bindPopup('Festejos Juninos :{$row->nome}').addTo(festas)";
            break;
        case 18:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: corpoIcon}).bindPopup('CVLI - 2020 :{$row->nome}').addTo(corpo2020)";
            break;
        case 19:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: corpoIcon}).bindPopup('CVLI - 2021 :{$row->nome}').addTo(corpo2021)";
            break;
        case 20:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: corpoIcon}).bindPopup('CVLI - 2022 :{$row->nome}').addTo(corpo2022)";
            break;
        case 21:
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: corpoIcon}).bindPopup('CVLI - 2023 :{$row->nome}').addTo(corpo2023)";
            break;
        default :
            echo 'L.marker([' . floatval($row->lat) . "," . floatval($row->log) . "],{icon: treIcon}).bindPopup('extra :{$row->nome}').addTo(extra)";
            break;
    }

    if (next($results)) {
        echo ",\n";
    }
}

echo ";";
?>