    <?php

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
ini_set('display_errors', 'Off');
error_reporting(E_ALL);


    require_once '../../../Libs/php/Conect.class.php';
    require_once './Colaborador.class.php';

    $Db = new Conect;
    
    chdir('../../../spr_files');
    $dir = getcwd();

    ($_REQUEST['id']) > 0 ? $r = 'alterar' : $r = 'incluir';
        
    if ($r === 'alterar') {

        if ($_FILES['foto']['tmp_name'] != '') {

            $foto = file_get_contents($_FILES['foto']['tmp_name']);
            $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
            $destpath = 'Colaborador_' . $_REQUEST['id'] . $tipo;
            file_put_contents($dir."/$destpath", $foto);
            $_REQUEST['foto'] = "/spr_files/$destpath";
        }

        $colab = new Colaborador($_REQUEST);
        $Db->AltObjeto($colab);
        echo "Cadastro Atualizado com Sucesso!";
    } else {
              
        isset($_REQUEST['foto'])?:$_REQUEST['foto']='';
        $colab = new Colaborador($_REQUEST);
        
        $id = $Db->AddObjeto($colab);
        
       
        if ($_FILES['foto']['tmp_name'] != '') {
            
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
            $tipo = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
            $destpath = 'Colaborador_' . $id . $tipo;
            file_put_contents($dir."/$destpath", $foto);
            
            $colab->setFoto("/spr_files/$destpath");
            $colab->setId($id);
            echo $Db->AltObjeto($colab);
        }
        return $id;
        echo "Cadastro realizado com Sucesso!";
    }

    unset($Prop);