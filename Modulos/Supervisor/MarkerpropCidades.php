<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../Libs/php/Conect.class.php';
$con = new Conect;

$dados = $con->Sql("SELECT id,nome,lat,log,nr_propriedade,tipoprop ,id_cidade
FROM
   propriedade;");

echo 'propriedades = L.layerGroup();';

while ($row = current($dados)) {
    switch ($row->tipoprop) {
        case 2:
            $icon = 'pin_green';
            break;
        case 3:
            $icon = 'pin_white';
            break;
        case 4:
            $icon = 'pin_yellow';
            break;
        case 5:
            $icon = 'pin_white';
            break;
        case 6:
            $icon = 'pin_lavender';
            break;
        case 7:
            $icon = 'pin_pink';
            break;
        case 8:
            $icon = 'pin_Brown';
            break;
        case 9:
            $icon = 'pin_eleicao';
            break;
        case 10:
            $icon = 'pin_eleicao_verde';
            break;
        case 11:
            $icon = 'pin_eleicao_amarelo';
            break;
        case 12:
            $icon = 'pin_eleicao_vermelho';
            break;
        case 13:
            $icon = 'pin_red';
            break;
        case 14:
            $icon = 'icon_77cipm';
            break;
        case 15:
            $icon = 'icon_78cipm';
            break;
        case 16:
            $icon = 'ubsIcon';
            break;
        case 17:
            $icon = 'festasIcon';
            break;
        case 18:
            $icon = 'icon_cruz';
            break;
        default:
            $icon = 'pin_blue';
            break;
    }

    echo "L.marker([" . trim(str_replace(',', '.', $row->lat)) . "," . trim(str_replace(',', '.', $row->log)) . "],{icon:$icon}).bindPopup('<span>Nr da Prop. :{$row->nr_propriedade}<br> Nome da Prop.:{$row->nome}<br> Município = {$row->id_cidade}<br> Coordenadas " . trim(str_replace(',', '.', $row->lat)) . " , " . trim(str_replace(',', '.', $row->log)) . "</span>').addTo(propriedades);\n";
    next($dados);
}

echo 'var overlays={"Propriedades": propriedades };';
echo 'mymap.addLayer(propriedades);';
echo '// remove the current control panel
      mymap.removeControl(baseControl);
      // add one with the cities
      propriedadesControl = L.control.layers(baseLayers, overlays).addTo(mymap);';
