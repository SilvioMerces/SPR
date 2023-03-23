<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL);

date_default_timezone_set('Brazil/East');
@session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Description of Conect
 *
 * @author richard
 * @version 2.0
 * @copyright (c) 2007, Richard Marques dos Santos
 * @todo 
 * 01 - Retirar a senha da conexao por questao de seguranca esta opcao deve ser
 * desabilitada na aplicacao.
 * 02 - implementar o metodo para exclusão de dados da aplicação
 * 
 */

class Conect {

    static $database = 'cipm9206_patrulharural';
    static $user = 'cipm9206_prural';
    static $pwd = '1(2DSa#t?QUK';
    static $conn;
    private $tplog = true;
    static $instance = null;

    //put your code here
    function setTplog($tplog) {
        $this->tplog = $tplog;
    }

    public function getRowsCount() {
        return $this->rowsCount;
    }

    public function __construct() {
        $this->conn = $this->getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new mysqli('localhost', self::$user, self::$pwd, self::$database);
        }
    }

    //anti inject para consultas de acÃ£o, inserÃ§Ã£o, alteraÃ§Ã£o,exclusÃ£o
    public function AntInject($sql) {
        // remove palavras que contenham sintaxe sql
        $a = array("from", "select", "insert", "delete", "where", "drop table", "show tables", "\*", "--", "\\\\");
        $sql = str_replace($a, "", $sql);
        $sql = trim($sql); //limpa espaÃ§os vazio
        $sql = strip_tags($sql, '<p><br><ol><li><ul><strong><span><em>'); //tira tags html e php
        $sql = pg_escape_string($sql);
        return $sql;
    }

    public function Sql($sql, $debug = false) {

        if ($debug) {
            echo '[' . $sql . "]<br>";
        }

        $result = self::$instance->query($sql);

        $objs = array();

        while ($data = mysqli_fetch_object($result)) {
            $objs[] = $data;
        }

        mysqli_free_result($result);

        return $objs;
    }

    public function AddObjeto($obj) {
        $cps = '';
        $vls = '';

        $objvars = $obj->getPropiedades();

        foreach ($objvars as $key => $vl) {

            if (!is_object($vl)) {
                if ($key != 'tabela') {
                    if (!empty($vl)) {

                        if ($this->CollTableExist($obj->getTabela(), $key) === 'true') {
                            if (is_array($vl)) {
                                $cps .= $key . ',';
                                $vlf = file_get_contents($vl['tmp_name']);
                                $vlf = $mysqli->real_escape_string($vlf);
                                $vls .= "'" . $vlf . "',";
                            } else {
                                $cps .= $key . ',';
                                $vls .= "'{$vl}'" . ',';
                            }
                        }
                    }
                }
            }
        }

        $cps = substr($cps, 0, (strlen($cps) - 1));
        $vls = substr($vls, 0, (strlen($vls) - 1));


        $sql = "INSERT INTO {$obj->getTabela()} ($cps) VALUES($vls) ;";
        
        //echo $sql;

        self::$instance->query($sql);

        $results = self::$instance->insert_id;
        
        return $results;
    }

    public function AltObjeto($obj) {
        $cps = '';

        $objvars = $obj->getPropiedades();

        foreach ($objvars as $key => $vl) {
            if (!is_object($vl)) {
                if ($key != 'tabela') {
                    if (!empty($vl)) {
                        if ($this->CollTableExist($obj->getTabela(), $key) === 'true') {
                            if (is_array($vl)) {

                                $vlf = file_get_contents($vl['tmp_name']);
                                $vlf = $mysqli->real_escape_string($vlf);
                                $cps .= $key . "='" . $vlf . "',";
                            } else {
                                $cps .= $key . "='{$vl}',";
                            }
                        }
                    }
                }
            }
        }

        $cps = substr($cps, 0, (strlen($cps) - 1));
        $a = "get" . ucfirst($obj->getNameId());

        $restric = $obj->$a();

        $sql = "UPDATE {$obj->getTabela()} SET $cps WHERE  {$obj->getNameId()}='$restric';";

       // echo $sql;

        self::$instance->query($sql);

        $results = self::$instance->insert_id;

        return $results;
        
    }

    public function DelObjeto($obj) {

        $cps = '';

        $objvars = $obj->getPropiedades();


        foreach ($objvars as $key => $vl) {
            if ($key != 'tabela') {
                if ($vl != '') {
                    if (is_array($vl)) {
                        $cps .= $key . "='" . pg_escape_bytea(file_get_contents($vl['tmp_name'])) . "',";
                    } else {
                        $cps .= $key . "='$vl',";
                    }
                }
            }
        }

        $cps = substr($cps, 0, (strlen($cps) - 1));
        $a = "get" . ucfirst($obj->getNameId());

        $restric = $obj->$a();

        $sql = "UPDATE {$obj->getTabela()} SET reg_ativo=false WHERE  {$obj->getId()}='$restric' returning {$obj->getNameId()};";

        //echo "SET DATESTYLE TO PostgreSQL,European; UPDATE {$obj->getTabela()} SET reg_ativo=false WHERE  {$obj->getId()}='$restric' returning {$obj->getNameId()};";


        $results = pg_query($sql) or die(pg_last_error());
        $result = pg_fetch_all($results);
        /*
         * @tudo 
         * verificar se o comando foi executado com sucesso pelo banco
         */
        $this->regLog("UPDATE", $obj->getTabela(), $_SESSION['USER'], $sql);

        return $result[0][$obj->getId()];
    }

    private function regLog($acao, $tabela, $usuario, $sql) {

        if (strlen($tabela) < 1) {
            $tabela = "busca";
        }
        $sql = "INSERT INTO ctl_usuario.log(acao, tabela, id_usuario, sql)VALUES ('" . gzencode($acao) . "', '$tabela', '$usuario', '$sql');";
        // $retorno = pg_query($this->conn, $sql);
    }

    public function getPrimaryKey($tabela) {
        $pk = $this->Sql("select coluna from estrutura_tb where tabela = 'pessoa' and substring(nome_chave,position('pkey' in nome_chave),char_length(nome_chave))= 'pkey';")[0]['coluna'];
        return $pk;
    }

    private function CollTableExist($tabela, $coll) {
        $sql = "select coluna from estrutura_tb where tabela = '$tabela' and coluna='$coll';";

        $result = self::$instance->query($sql);

        $objs = array();

        while ($data = mysqli_fetch_object($result)) {
            $objs[] = $data;
        }

        mysqli_free_result($result);

        $obj_array = (array) $objs[0];

        if (!empty($obj_array[0]['coluna'])) {
            return 'false';
        } else {
            return 'true';
        }
    }

}
