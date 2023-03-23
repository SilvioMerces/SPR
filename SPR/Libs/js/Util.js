/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//URL = window.location.href;
//if (URL.indexOf('?') > 0) {
//var Base_URL = window.location.protocol + "//" + window.location.hostname+'/SPR/';
var Base_URL = window.location.protocol + "//" + window.location.hostname;
//}else{
//    var Base_URL = URL;
//}
var LeafIcon = L.Icon.extend({options: {iconSize: [38, 95]}});
var pin_blue = new LeafIcon({iconUrl: '../Templates/imgs/pin_blue.svg'}),
        pin_green = new LeafIcon({iconUrl: '../Templates/imgs/pin_green.svg'}),
        pin_red = new LeafIcon({iconUrl: '../Templates/imgs/pin_red.svg'}),
        pin_yellow = new LeafIcon({iconUrl: '../Templates/imgs/pin_yellow.svg'}),
        pin_white = new LeafIcon({iconUrl: '../Templates/imgs/pin_white.svg'}),
        pin_lavender = new LeafIcon({iconUrl: '../Templates/imgs/pin_lavender.svg'}),
        pin_pink = new LeafIcon({iconUrl: '../Templates/imgs/pin_pink.svg'});
        pin_Brown = new LeafIcon({iconUrl: '../Templates/imgs/pin_brown.svg'});
        pin_eleicao = new LeafIcon({iconUrl: '../Templates/imgs/pin_eleicao.svg'});

var offset = 0;
var limit = 12;

fetch(window.location.protocol + "//" + window.location.hostname + '/Libs/php/session_export.php')
        .then(response => {
            return response.json()
        })
        .then(data => {
            // Work with JSON data here

            if (window.location.href.indexOf('?') > 0) {
                window.location.href = window.location.href.slice(0, window.location.href.indexOf('?') - 1);
            } else {
                alert('Bemvindo ' + data.Nome);
            }

        })
        .catch(err => {
            // Do something for an error here
        });


function mudaCidadeMapa(cidade) {
    var xmlhttp = new XMLHttpRequest();
    var url = "Libs/php/cidade4id.php?nome=" + cidade;
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            SetaMapa(myArr);
        }
    };
    xmlhttp.open("GET", url, false);
    xmlhttp.send();
}

function SetaMapa(arr) {
    if (arr !== null) {
        mymap.setView([arr.latitude, arr.longitude], 14);
        L.marker([arr.latitude, arr.longitude], {draggable: true}).addTo(mymap);
    }
}

function valueSelect(selectId) {
    var x = document.getElementById(selectId).value;
    return x;
}



function PopulaSelect(MySelect, getURL) {
    MySelect.length = 0;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            obj = JSON.parse(this.responseText);
            addOptions(MySelect, obj);
        }
    };
    xmlhttp.open("GET", getURL, false);
    xmlhttp.send();
}

function addOptions(MySelect, objJson) {

    for (i in objJson.obj) {
        var x = document.createElement("option");
        if (objJson.obj[i].nome != undefined) {

            x.value = objJson.obj[i].id;
            x.text = objJson.obj[i].nome;
            MySelect.add(x);
        }
    }

}

var map = {"â": "a", "Â": "A", "à": "a", "À": "A", "á": "a", "Á": "A", "ã": "a", "Ã": "A", "ê": "e", "Ê": "E", "è": "e", "È": "E", "é": "e", "É": "E", "î": "i", "Î": "I", "ì": "i", "Ì": "I", "í": "i", "Í": "I", "õ": "o", "Õ": "O", "ô": "o", "Ô": "O", "ò": "o", "Ò": "O", "ó": "o", "Ó": "O", "ü": "u", "Ü": "U", "û": "u", "Û": "U", "ú": "u", "Ú": "U", "ù": "u", "Ù": "U", "ç": "c", "Ç": "C", " ": ""};
function removerAcentos(s) {
    return s.replace(/[\W\[\] ]/g, function (a) {
        return map[a] || a;
    });
}

function qtdselect(obj) {
    var inputs = document.getElementsByName(obj.name);
    ct = 0;

    for (i = 0; i < inputs.length; i++) {
        if (inputs[i].checked == true) {
            ct++;
        }
    }

    document.getElementById('qtd_atv').innerHTML = ct;
}

function execFunc(nome_funcao, parametro) {
    window[nome_funcao](parametro);
}

function pegaEnderecoCoord(lat, lon) {
    url = 'https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lon + '&format=json';
    fetch(url)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Work with JSON data here
                cidade = 'c';
                if (data.address.town !== undefined)
                    cidade = data.address.town;
                if (data.address.city !== undefined)
                    cidade = data.address.city;
                if (data.address.village !== undefined)
                    cidade = data.address.village;
                if (data.address.district !== undefined)
                    cidade = data.address.district;

                urla = 'Libs/php/cidade4nome.php?nome=' + cidade;

                fetch(urla)
                        .then(response => {
                            return response.json()
                        })
                        .then(data => {
                            // Work with JSON data here
                            setSelect('cidade', data.obj[0].codigo_ibge)
                        })
                        .catch(err => {
                            // Do something for an error here
                        });
            })
            .catch(err => {
                // Do something for an error here
            });
}

function readURL(input, imgName) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById(imgName).setAttribute('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showCorpo() {
    document.getElementById('Corpo').style.visibility = 'visible';
}

function callFormDetail(tit, link, func) {
    if (document.getElementById('id').value > 0) {
        ShowFormDetail(tit);
        ObjProcAjax.run(link, func);
    }
}

function disabilitaTollLinks() {
    if (document.getElementById('id').value > 0) {

        var tolLink = document.getElementById("tolllinks");
        elements = tolLink.getElementsByClassName('abuttom');

        for (i = 0; i < elements.childElementCount; i++) {
            elements[i].classList.add("disabled");
        }

    }
}

function ShowFormDetail(tit) {

    if (document.getElementById('formDetail').style.display === 'none' || document.getElementById('formDetail').style.display === '') {
        document.getElementById('formDetail').style.display = 'block';
        document.getElementById('titDetail').innerHTML = tit;

        img = document.createElement("img");
        img.setAttribute("src", "Templates/imgs/btn_close.svg");
        img.setAttribute("onclick", "document.getElementById('formDetail').style.display = 'none';");
        document.getElementById('titDetail').appendChild(img);

    } else {
        document.getElementById('formDetail').style.display = 'none';
    }
}

function SetaNomeCidadeinput(lat, lon, idinput) {
    document.getElementById('carregando').style.display = 'block';
    URL = 'https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lon + '&format=json';

    fetch(URL)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Work with JSON data here

                if (data.address.town !== undefined) {//cidade
                    document.getElementById(idinput).value = data.address.town;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }
                if (data.address.city !== undefined) {//cidade
                    document.getElementById(idinput).value = data.address.city;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }
                if (data.address.municipality !== undefined) {//municipio
                    document.getElementById(idinput).value = data.address.municipality;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }
                if (data.address.village !== undefined) {//vila, vilarejo
                    document.getElementById(idinput).value = data.address.village;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }
                if (data.address.district !== undefined) {//distrito
                    document.getElementById(idinput).value = data.address.district;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }
                if (data.address.hamlet !== undefined) {//aldeia
                    document.getElementById(idinput).value = data.address.hamlet;
                    document.getElementById('carregando').style.display = 'none';
                    return true;
                }

            }
            )
            .catch(err => {
                // Do something for an error here
            });


}

function addVisita(resultado) {
    if (resultado.isInteger) {
        document.getElementById('id').value = resultado;
        if (confirm("Deseja Cadastrar uma nova propriedade?")) {
            document.getElementById('resetar').click();
        }
    } else {
        alert(resultado);

    }
}

function setaMacadores() {
    for (var i = 0; i < addressPoints.length; i++) {
        var a = addressPoints[i];
        var title = a[2];
        var marker = L.marker(L.latLng(a[0], a[1]), {title: title});
        marker.bindPopup(title);
        markerList.push(marker);
    }
}

function loadjscssfile(filename, filetype) {
    if (filetype == "js") { //if filename is a external JavaScript file
        var fileref = document.createElement('script')
        fileref.setAttribute("type", "text/javascript")
        fileref.setAttribute("src", filename)
    } else if (filetype == "css") { //if filename is an external CSS file
        var fileref = document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    if (typeof fileref != "undefined")
        document.getElementsByTagName("head")[0].appendChild(fileref)
}

function BuscaDados() {
    Caller ='/Modulos/Propriedade/listaPropriedade.php'; 
    TargetTable = 'view_propriedades';
    restrict='busca';
    valor=document.getElementById('busca').value;
    tbfields='id,nr_propriedade,nome,cidade,nome_colaborador,lat,log'; 
    TrgRowLink='/Modulos/Propriedade/formPropriedade.php';

    url = window.location.protocol + "//" + window.location.hostname + "/Libs/php/BuscaTabela.php?campos=count(*) as total&para=" + TargetTable + "&restricao=" + restrict + "&operador=LIKE&busca=" + valor;

    fetch(url)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Work with JSON data here
                total = data[0].total;
                document.getElementById('messageValue').innerHTML = 'Registros encontrados : ' + total;
            })
            .catch(err => {
                // Do something for an error here
            });

    url = window.location.protocol + "//" + window.location.hostname + "/Libs/php/BuscaTabela.php?campos=" + tbfields + "&para=" + TargetTable + "&restricao=" + restrict + "&operador=LIKE&busca=" + valor + "&parametros= order by id desc limit " + limit + " offset " + offset;

    fetch(url)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Work with JSON data here
                obj = data;
                addTableRows(Caller, obj, TrgRowLink);
            })
            .catch(err => {
                // Do something for an error here
            });
}

function addTableRows(caller, obj, TrgRowLink) {
    var table = document.getElementById("myTable");

    while (table.rows.length > 1) {
        table.deleteRow(1);
    }

    Object.entries(obj).forEach(
            ([key, value]) => {
        i = value.length;
        row = table.insertRow(table.rows.length);
        Object.entries(value).forEach(([k, v]) => {
            cell = row.insertCell(i);
            cell.innerHTML = v;
        })
        var imgb = document.createElement("img");
        imgb.src = "Templates/imgs/edit.svg";
        imgb.width = 30;
        imgb.setAttribute("onclick", "ObjProcAjax.run(Base_URL+'" + TrgRowLink + "?id=" + value.id + "','Corpo')");
        cell = row.insertCell(i);
        cell.appendChild(imgb);
        i--;
    });



}

function moveToPrevius() {
    valor = document.getElementById('busca').value;
    offset = offset - limit;
    BuscaDados();
}

function moveToNext() {
    valor = document.getElementById('busca').value;
    offset = offset + limit;
    BuscaDados();
}

function moveToFirst() {
    offset = 0;
    BuscaDados();
}

function moveToLast() {
    offset = total - limit;
    BuscaDados();

}

function pegaPropsCidade(city) {
    urlp = window.location.protocol + "//" + window.location.hostname + window.location.pathname + '/Modulos/Supervisor/MarkerpropCidades.php?id_cidade=' + city;
    var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            try {
                removeLayer();
            } catch (e) {
                console.log("erro! markers não existem.")
            }
            eval(this.responseText);
            var overlays = {"Propriedades": propriedades};
            mymap.addLayer(propriedades);

            // remove the current control panel
            mymap.removeControl(baseControl);
            // add one with the cities
            propriedadesControl = L.control.layers(baseLayers, overlays).addTo(mymap);
            mymap.panTo([-16.6864, -49.2643]);
        }
    }

    ajx.open('GET', urlp, false);
    ajx.send();
}