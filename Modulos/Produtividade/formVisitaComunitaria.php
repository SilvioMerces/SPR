<style>
    .col-2{
        padding: 0.2em;
    }

    .col-2 label{
        display: inline-block;
        min-width: 10em;
    }
</style>
<label class="TituloForm">Cadastro de Visita Comunitária</label>
<form action="/Modulos/Produtividade/ctrl_produtividade.php" method="POST" enctype="multipart/form-data" id='frm_monitoramento'  >
    <!--<form action="Modulos/Propriedade/ctrl_propriedade.php" method="POST" enctype="Multipart/form-data" id='frm_monitoramento' onsubmit="return false;"  >-->

    <input type="hidden" name="tipo" id="tipo" value="30176"/>
    <input type="hidden" name="tipo_local" id="tipo_local" value="zona rural" />
    <input type="hidden" name="tipo_especifico_local" id="tipo_especifico_local" value="propriedade rural" />
    <input type="hidden" name="municipio" id="municipio" value="2933307" />
    <div class="col-2">
        <label for="pref_vtr">Prefixo da Vtr :</label><input type="text" name="pref_vtr" id="pref_vtr" />
    </div>
    <div class="col-2">
        <label for="datavisita">Data da Visita :</label><input type="text" name="datavisita" id="datavisita" value="<?php echo date("d/m/Y") ?>" />
    </div>

    <div class="col-2">
        <label for="cod_propriedade">Código da Propriedade :</label><input type="text" name="cod_propriedade" id="cod_propriedade" />
    </div>
    <div class="col-2">
        <label for="nome_propriedade">Nome da Propriedade :</label><input type="text" name="nome_propriedade" id="nome_propriedade" />
    </div>

    <div class="col-3">
        <label for="nome">Nome visitado:</label><input type="text" name="nome" id="nome" />
    </div>
    <div class="col-3">
        <label for="datnas">Data de nascimento :</label><input type="text" name="datnas" id="datnas" />
    </div>
    <div class="col-3">
        <label for="telefone">Telefone :</label><input type="text" name="telefone" id="telefone" />
    </div>

    <div class="col-2">
        <label for="rg">Rg :</label><input type="text" name="rg" id="rg" />
    </div>
    <div class="col-2">
        <label for="cpf">CPF :</label><input type="text" name="cpf" id="cpf" />
    </div>

    <div class="col-2">
        <label for="lat">Latitude :</label><input type="text" name="lat" id="lat" /></div>
    <div class="col-2">
        <label for="log">Longitude :</label><input type="text" name="log" id="log" />
    </div>
    <div class="col-2">
        <label for="obs">Breve Relato :</label><textarea name="obs" id="obs"></textarea>
    </div>
    <div class="col-2">
        <label for="foto">Foto :</label><input type="file" name="foto" id="foto" />
    </div>

    <div class="col-1">
        <input class="btn btnAdd" type="submit" value="Incluir Visita" />
    </div>
</form>
