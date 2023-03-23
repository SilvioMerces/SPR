<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Conect.class.php';

class util {

    private $CON;

    public function __construct() {
        $this->CON = new Conect();
    }

    function populaSelect($nome, $chave, $tabela, $restricao = null, $orderby = null, $defalt = null) {

        $orderby == null ? $orderby = $nome : $orderby = $chave;

        $retorno = '';

        if ($restricao != null) {
            $restricao = ' WHERE 1=1 AND ' . $restricao;
        }

        $sql = "SELECT {$nome},{$chave} FROM {$tabela} $restricao order by {$orderby}";
        $dados = $this->CON->Sql($sql);

        $retorno = "<option >:: Escolha o Valor para {$tabela} ::</option>";

        while ($row = current($dados)) {
            if ($row->$chave == $defalt) {
                $retorno .= "<option selected value='{$row->$chave}'>{$row->$nome}</option>";
            } else {
                $retorno .= "<option value='{$row->$chave}'>{$row->$nome}</option>";
            }
            next($dados);
        }

        return $retorno;
    }
    
    public  function formatdataIn($data){
        /*transforma a data para inclusao em um imput tipo date yyyy-mm-ddd*/;
        $date = explode('/',$data);
        return $date[2].'-'. $date[1].'-'.$date[0];
    }

}
