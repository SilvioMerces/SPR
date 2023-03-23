<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Sistema Patrulha Rural-Georreferenciada (SPR)</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

        <link rel="stylesheet" href="Templates/css/MarkerCluster.css" />
        <link rel="stylesheet" href="Templates/css/MarkerCluster.Default.css" />
        <script src="Libs/js/leaflet.markercluster-src.js"></script>

        <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />

        <script type="text/javascript" src="Libs/js/Util.js" charset="UTF-8"></script>
        <script type="text/javascript" src="Libs/js/Ajax.js" charset="UTF-8"></script>
        <script type="text/javascript" src="Libs/js/ProcessaAjax.js" charset="UTF-8"></script>
        <script type="text/javascript" src="Libs/js/spr_functions.js" charset="UTF-8"></script>

        <link href="Templates/css/Default.css" rel="stylesheet" type="text/css">
        <link href="Templates/css/MenuVert.css" rel="stylesheet" type="text/css">
        <link href="Templates/css/Forms.css" rel="stylesheet" type="text/css">
        <link href="Templates/css/FormBusca.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="Templates/imgs/favicon.png" />

    </head>
    <body><input type="checkbox" name="meuperfil" id="meuperfil" style="display: none;">
        <div class="system">
            <div class="top" ></div> 
            <div class="menu_lateral" >
                <div class="foto"></div>
                <div class="logo"></div>
                <ul class="mmAdmin">
                    <li><label for="chemenu" >MENU</label><input type="checkbox" id="chemenu" name="chemenu"/>
                        <ul>
                            <li><label for="meuperfil">Perfil</label></li>
                            <li><a href="?">Recarregar</a></li>
                            <li><a>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="tMenu">MENU</div>
                <?php require_once './Templates/menu/menu_vert.php'; ?>

            </div>
            <div class="about">
                <span>Sistema Patrulha Rural</span>
                <span>Version 2.0 / 2019</span>
            </div>

            <div id="Corpo" class="Corpo">
               <center> <h1>92ª Companhia Independente de Polícia Militar / Vitória da Conquista-Bahia. </h1><br><b></b></B> <H1>SPR - Sistema de Patrulhamento Rural Georreferenciada</H1></center> 
                <div><center>
                    <BR>
                            <img width="700px" src="Templates/imgs/capa.jpeg"/>
                        </center>
                    </div> 
            </div>
        </div>

        <div class="modal-content"> 
            <label for="meuperfil">X</label>
            <div> 
                <div> 
                    <div><center>
                            <img width="90px" src="Templates/imgs/user_default.svg"/>
                        </center>
                    </div> 
                    <div class="help-block" style="text-align: center"> <p>Foto Sicad</p> </div> 
                </div> 
            </div> 
            <div id="MeuPerfil" >
                <p ><strong>Usuário Gestor</strong></p> 
                <p ng-show="dadosUsuario.corporacao" class="text-left small"><b>Corporação:</b> PM </p> 
                <p ng-show="usuarioPerfil.descricao" class="text-left small ng-hide"><b>Perfil:</b>  </p> 
                <p ng-show="dadosUsuario.email" class="text-left small"><b>Email:</b> richard.santos@pm.go.gov.br </p> 
                <p ng-show="dadosUsuario.cpf" class="text-left small"><b>CPF:</b> 53335317149 </p> 
                <p ng-show="dadosUsuario.telefone" class="text-left small"><b>Telefone:</b> (62) 99224-0849 </p> 
            </div> 
            <div style="margin-top: 20px" class="col-lg-12"> 
                <fieldset> 
                    <legend style="font-size: small;font-weight: bold">Minha unidade de trabalho atual</legend> 
                    <ul class="list_unidades_" style="font-size: small;margin-left: 0px"> <li> BATALHÃO DE POLÍCIA MILITAR RURAL (CME)</li> </ul> 
                    <ul class="list_unidades_" style="font-size: small;margin-left: 0px;color: #999"> <!----> </ul> 
                </fieldset> 
            </div> 
        </div>
    </body>
</html>