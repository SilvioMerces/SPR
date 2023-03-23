<style>
    table{
        font-family: Helvetica, sans-serif;
        letter-spacing: 2px;
        border-spacing: 0;
        font-size: 9; 
    }
    th,td{
        padding: 0.5em;
    }

    tr:nth-child(even){
        background-color: whitesmoke;
    }
    thead tr th{
        border-bottom: 1px solid red;
        background-color: black;
        color: whitesmoke;
    }

</style>
<button onclick="exportTableToExcel('rel_visitaComunitaria','VisitasComunitárias_<?php echo date("d-m-Y");?>')">Exportar para Excel</button>
    <table id='rel_visitaComunitaria'>
        <thead>
            <tr>
                <th>C&oacute;d.</th>
                <th>Munic&iacute;pio</th>
                <th>Viatura</th>
                <th>Cód. da Propriedade</th>
                <th>Nome da propriedade</th>
                <th>Nome do visitado</th>
                <th>RG</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Tipo de ocal</th>
                <th>Tipo específico de local</th>
                <th>Latitude</th>
                <th>Logitude</th>
                <th>Obs.</th>
                <th>Data da visita</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../Libs/php/Conect.class.php';
            $db = new Conect;
            $dados = $db->Sql("SELECT id,municipio,pref_vtr,cod_propriedade,nome_propriedade,nome,rg,cpf,datanas,telefone,tipo_local,tipo_especifico_local,latitude,longitude,obs,datavisita FROM produtividade order by id desc;");
            while ($row = current($dados)) {
                echo '<tr>';
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo '</tr>';
                next($dados);
            }
            ?>
        </tbody>
    </table>
