<label id="TituloForm">Pesquisar Usuários </label>
<div class="corpoForm">  
    <span class="busca"><label for="busca"></label><input type="text" id="busca" onkeyup="BuscaDados('/Modulos/Usuario/UserManager.php', 'usuario', 'login', this.value, 'id,login,cpf,perfil,ativo', 10, 0,'/Modulos/Usuario/FormUser.php')"  name="busca"   /></span>
</div>
<div id="resul_search">
    <table id="myTable" border="1">
        <tr>
            <td>id</td>
            <td>Login</td>
            <td>cpf</td>
            <td>Perfil</td>
            <td>Status</td>
            <th>Editar</th>
        </tr>
    </table>
    <table class="paginacao" >
        <tr>
            <th><img id="moveFirst" src="../../Templates/imgs/go-first.svg" width="30" onclick="moveToFirst()"></th>
            <th><img id="movePrevius" src="../../Templates/imgs/go-previus.svg" width="30" onclick="moveToPrevius()"></th>
            <th id="messageValue">...</th>
            <th><img id="moveNext" src="../../Templates/imgs/go-next.svg" width="30" onclick="moveToNext()"></th>
            <th><img id="moveLast" src="../../Templates/imgs/go-last.svg" width="30" onclick="moveToLast()"></th>
        </tr>
    </table>
</div>
