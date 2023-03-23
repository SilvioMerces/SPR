
<label class="TituloForm">Cadastro de Visita Solidária </label>
<div class="col col-2" >
    <form action="Modulos/Propriedade/ctrl_propriedade.php" method="POST" enctype="Multipart/form-data" id='frm_propriedade' onsubmit="return false;"  >
        <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>" />
        <input type="hidden" id="cod_propriedade" name="cod_propriedade" value="<?php echo $Prop->getCod_propriedade(); ?>" />
        <div class="col col-2">
            <span><label for="crpm">CRPM</label><select id="crpm" name="crpm" onchange="mudaOpmCrpm('opm', this.value);"><?php echo $ut->populaSelect('sigla', 'id', 'view_crpm', null, 'id') ?></select></span>
            <span><label for="opm">OPM</label><select id="opm" name="opm" onchange="mudaCidadeCrpm('cidade', this.value)" ><option>Escolha o CRPM!</option></select></span>
            <span><label for="cidade">Cidade</label><select id="cidade" name="cidade"  onchange="mudaZonaRural('zonarural', this.value);
                    cidade2Mapa(this.value);" ><option>Escolha a OPM!</option></select></span>
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
            <span><label for="nome">Nome da Propriedade</label><input type="text" id="nome" name="nome"  value="<?php echo $Prop->getNome(); ?>" /></span>
            <span><label for="numero">Número da Propriedade</label><input type="text" id="numero" name="numero" value="<?php echo $Prop->getNr_propriedade(); ?>" /></span>
        </div>
        <div class="col col-2">
            <span><label for="referencia">Referência</label><input type="text" id="referencia" name="referencia" value="<?php echo $Prop->getReferencia(); ?>" /></span>
            <span><label for="referencia">Latitude</label><input type="text" id="lat" name="lat" value="<?php echo $Prop->getLat(); ?>" onchange="reposicionaMarkerPropriedade()" /> </span>
            <span><label for="referencia">Longitude</label><input type="text" id="log" name="log" value="<?php echo $Prop->getLog(); ?>" onchange="reposicionaMarkerPropriedade()" /></span>
            <span><label for="rede">Nome da Rede Wifi</label><input type="text" id="rede" name="rede" value="<?php echo $Prop->getRedewifi(); ?>" /></span>
            <span><label for="senha">Senha da Rede Wifi</label><input type="text" id="senha" name="senha" value="<?php echo $Prop->getSenhawifi(); ?>" /></span>
            <span><label for="defencivo">Usa Defencivo agricola?</label><input type="radio" id="defensivo" name="defensivo" value="true" />Sim<input type="radio" id="defensivo" name="defensivo" value="false" />Não</span>
            <span><label for="mes_ini">Mês de Início</label><input type="text" id="mes_ini" name="mes_ini" value="<?php echo $Prop->getSenhawifi(); ?>" /></span>
            <span><label for="Mes_fin">Mes de Termino</label><input type="text" id="Mes_fin" name="Mes_fin" value="<?php echo $Prop->getSenhawifi(); ?>" /></span>
        </div>
    </form>
</div>