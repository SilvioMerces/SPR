<ul class="mmContend">
    <font size ="4" face="Tahoma">
    <li><label for="Atendimento"><b>Atendimento</b></label><input type="checkbox" id="Atendimento"/>
        <ul>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/listarPropriedades.php', 'Corpo')">Minhas Propriedades</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/formPropriedade.php', 'Corpo')">Cadastrar Propriedades</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Produtividade/formMonitoramento.php', 'Corpo')">Monitoramento</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Produtividade/formVisitaComunitaria.php', 'Corpo')">Visita Comunitaria</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Produtividade/formVisitaSolidaria.php', 'Corpo')">Visita Solidária</a></li>
            <li><a>Pesquisa</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/RelatorioAnaliticoPropriedades.php', 'Corpo')">Relatório Propriedade</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Propriedade/Gerar_Numeracao.php', 'Corpo')">Relatório Números Propriedade</a></li>
        </ul>
    </li> 
    <li><label for="Supervisor"><b>Supervisor</b></label><input type="checkbox" id="Supervisor"/>
        <ul>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/TrackingVtr/FormTraking.php','Corpo');return null" >Monitoramento das Equipes da Patrulha Rural</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/listaPropriedadesGeo.php','Corpo');return null" >Lista Georreferenciada de Propriedades</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/listarViaturas.php','Corpo');return null" >Monitorar Viaturas</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/listaVtrPropriedadesGeo.php','Corpo');return null" >Propriedade & Viaturas</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/regioesPropriedadesGeo.php','Corpo');return null" >Propriedade por Regiões Adm</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/QuadrantesGeo.php','Corpo');return null" >Quadrantes</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/Tarefa.php','Corpo');return null" >Tarefas</a></li>
            <li><a>Listar Visistas</a></li>
        </ul>
    </li>
    <li><label for="analitico"><b>Relatórios Analíticos</b></label><input type="checkbox" id="analitico"/>
        <ul>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Relatorios/Rel_Analitico_Visitas_comunitaria.php\',\'Corpo\');return null">Visitas Comunitárias</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + '/Modulos/Supervisor/relatorio_visitas_solidarias.php\',\'Corpo\');return null">Visitas Solidárias</a></li>

        </ul>
    </li>
    <li><label for="Graficos"><b>Gráficos</b></label><input type="checkbox" id="Graficos"/>
        <ul>
            <li><a>Visitas Mensais</a></li>
            <li><a>Visitas Por CRPM</a></li>
        </ul>
    </li>
    <li><label for="adm"><b>Administração</b></label><input type="checkbox" id="adm"/>
        <ul>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + \'/Modulos/Usuario/UserManager.php\',\'Corpo\');return null">Usuários</a></li>
            <li><a>Perfis</a></li>
            <li><a onclick="showCorpo(); ObjProcAjax.run(Base_URL + \'/Admin/OPM/AtualizaOPM.php\',\'Corpo\');return null">OPM\'s</a></li>
        </ul>
    </li>
    <li><a><b>Documentos</b></a></li>
    <li><a>Logs</a></li>
    <li><label for="basc">Básicos</label><input type="checkbox" id="basc"/>
        <ul>
            <li><a>Marcador</a></li>
            <li><a>Cidade</a></li>
            <li><a>Atividade Rural</a></li>
        </ul>
    </li>
    <li><label for="Logout"><b>Sair do sistema</b></label><input type="checkbox" id="Logout"/>
        <ul>
            <li><a href="logout.php?access_token=<?php echo $_SESSION['access_token']; ?>">Sair do Sistema</a></li>
        </ul>
    </li>
    </font>
</ul>