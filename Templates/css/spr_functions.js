function addMaqEquip(resultado) {
    if (resultado.isInteger) {
        document.getElementById('id_MaqEquip').value = resultado;
        if (confirm("Deseja Cadastrar um novo Equipamento/Maquina?")) {
            document.getElementById('reset_id_marca').click();
        }
    } else {
        alert(resultado);
    }

    if ((document.getElementById('id_MaqEquip').value > 0)) {
        document.getElementById('acao_MaqEquip').value = "Alterar";
    } else {
        document.getElementById('acao_MaqEquip').value = "Incluir";
    }

    document.getElementById('tab2').checked = true;
}

function addColaborador(resultado) {
    if (resultado.isInteger) {
        document.getElementById('id_colaborador').value = resultado;
        if (confirm("Deseja Cadastrar um novo Colaborador?")) {
            document.getElementById('reset_colaborador').click();
        }
    } else {
        alert(resultado);
    }

    if ((document.getElementById('id_colaborador').value > 0)) {
        document.getElementById('acao_colaborador').value = "Alterar";
    } else {
        document.getElementById('acao_colaborador').value = "Incluir";
    }
    document.getElementById('tab2').checked = true;
}

function addMarca(resultado) {

    if (resultado.isInteger) {
        document.getElementById('id_marca').value = resultado;
        if (confirm("Deseja Cadastrar uma nova Marca?")) {
            document.getElementById('reset_id_marca').click();
        }
    } else {
        alert(resultado);
    }
    if ((document.getElementById('id_marca').value > 0)) {
        document.getElementById('acao_id_marca').value = "Alterar";
    } else {
        document.getElementById('acao_id_marca').value = "Incluir";
    }
    document.getElementById('tab2').checked = true;
}

function addFachada(resultado) {
    if (resultado.isInteger) {
        document.getElementById('id_colaborador').value = resultado;
        if (confirm("Foto da Fachada Incluida com Sucesso!")) {
            document.getElementById('reset_fachada').click();
        }
    } else {
        alert(resultado);
    }
}

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

function addLstProp(idtable, source, icon) {
    if (event.keyCode === 38)
        return false;
    if (event.keyCode === 37)
        return false;
    if (event.keyCode === 40)
        return false;
    if (event.keyCode === 39)
        return false;

    url = window.location.protocol + "//" + window.location.hostname + source;
    obj = null;

    var table = document.getElementById(idtable);

    while (table.rows.length > 0) {
        table.deleteRow(0);
    }

    fetch(url)
            .then(response => {
                return response.json()
            })
            .then(data => {
                // Work with JSON data here
                obj = data;
                if (obj != null) {
                    Object.entries(obj).forEach(
                            ([key, value]) => {
                        i = value.length;
                        row = table.insertRow(table.rows.length);
                        lat = 0;
                        long = 0;
                        id = 0;

                        Object.entries(value).forEach(([k, v]) => {
                            if (k !== 'lat' && k !== 'log' && k !== 'id') {
                                cell = row.insertCell(i);
                                cell.innerHTML = v;
                            }
                            if (k === 'lat') {
                                lat = v;
                            }
                            if (k === 'log') {
                                long = v
                            }
                            if (k === 'id') {
                                id = v
                        }
                        })

                        var imgb = document.createElement("img");
                        imgb.src = icon;
                        imgb.width = 30;
                        imgb.setAttribute("onclick", "addMarkerMap(" + lat + "," + long + "," + id + ")");
                        cellu = row.insertCell(i);
                        cellu.appendChild(imgb);
                        i--;
                    });

                }
            })
            .catch(err => {
                // Do something for an error here
            });


}

function addColaborador() {
    alert('Pessoa Registrada com Sucesso!');
    ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Colaborador/ListaColaboradores.php', 'tabcontent');
}

function ValidaFormColaborador(idform) {
    FormElements = document.getElementById(idform).elements;

    if (FormElements.nome.value.toString().trim() === "" || FormElements.mae.value.toString().trim() === "") {

        alert('Vocé deve Informar Obrigatoriamente o nome da Pessoa e o nome da Mãe!');

        return false;
    } else {
        return true;
    }
}