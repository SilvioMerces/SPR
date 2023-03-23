<?php

/*
 * To change this license header, choose License Headers in Project Properties
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Description of Propriedade
 *
 * @author richard
 */
include_once '../../Libs/php/Conect.class.php';

class Propriedade extends Conect {

    private $id;
    private $id_atividade;
    private $nome;
    private $lat='-14.85397674075405';
    private $log='-40.84356348882157';
    private $nr_propriedade;
    private $referencia;
    private $id_cidade;
    private $nome_cidade;
    private $zona_rural;
    private $redewifi;
    private $senhawifi;
    private $defensivo;
    private $def_mes_ini;
    private $def_mes_fim;
    private $crpm_id;
    private $opm_id;
    private $con;
    private $cod_propriedade;
    private $tipoprop;

    //put your code here

    public function __construct($dados = null) {
        $this->con = new Conect;

        if (!is_null($dados)) {

            $this->id = $dados['id'];
            $this->id_atividade = $dados['id_atividade'][0];
            $this->nome = $dados['nome'];
            $this->lat = $dados['lat'];
            $this->log = $dados['log'];
            $this->redewifi = $dados['rede'];
            $this->senhawifi = $dados['senha'];
            $this->nr_propriedade = $dados['numero'];
            $this->referencia = $dados['referencia'];
            $this->id_cidade = $dados['cidade'];
            $this->zona_rural = $dados['zonarural'];
            $this->cod_propriedade = $dados['cod_propriedade'];
            $this->defensivo = $dados['defensivo'];
            $this->def_mes_ini = $dados['def_mes_ini'];
            $this->def_mes_fim = $dados['def_mes_fim'];
            $this->opm_id = $dados['opm'];
            $this->tipoprop = $dados['tipoprop'];

            $obj = $this->con->Sql("SELECT codigo_ibge, nome, latitude, longitude ,sigla, id, sigla_crpm, id_crpm FROM view_municipios_opm WHERE codigo_ibge = " . $this->id_cidade);
            $this->nome_cidade = $obj[0]->nome;

            $objc = $this->con->Sql("SELECT id_superior FROM view_opm WHERE id = " . $this->opm_id);
            $this->crpm_id = $obj[0]->id_superior;

            unset($obj);
        }
    }

    public function getDefensivo() {
        return $this->defensivo;
    }

    public function getDef_mes_ini() {
        return $this->def_mes_ini;
    }

    public function getDef_mes_fim() {
        return $this->def_mes_fim;
    }

    public function setDefensivo($defensivo) {
        $this->defensivo = $defensivo;
        return $this;
    }

    public function setDef_mes_ini($def_mes_ini) {
        $this->def_mes_ini = $def_mes_ini;
        return $this;
    }

    public function setDef_mes_fim($def_mes_fim) {
        $this->def_mes_fim = $def_mes_fim;
        return $this;
    }

    public function getNameId() {
        return 'id';
    }

    public function getId() {

        $ret = empty($this->id) ? -1 : $this->id;

        return $ret;
    }

    public function getId_atividade() {
        return $this->id_atividade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getLat() {
        return $this->lat;
    }

    public function getLog() {
        return $this->log;
    }

    public function getNr_propriedade() {
        return $this->nr_propriedade;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function getId_cidade() {
        return $this->id_cidade;
    }

    public function getNome_cidade() {
        return $this->nome_cidade;
    }

    public function getZona_rural() {
        return $this->zona_rural;
    }

    public function getRedewifi() {
        return $this->redewifi;
    }

    public function getSenhawifi() {
        return $this->senhawifi;
    }

    public function getCrpm_id() {
        return $this->crpm_id;
    }

    public function getOpm_id() {
        return $this->opm_id;
    }

    public function getCod_propriedade() {
        return $this->cod_propriedade;
    }

    public function setCod_propriedade($cod_propriedade) {
        $this->cod_propriedade = $cod_propriedade;
        return $this;
    }

    public function setPropriedade($id) {

        $obj = $this->con->Sql("SELECT
   propriedade.*,
   organizacao.sigla,
   view_crpm.id as crpm_id,
   municipio.nome as nome_cidade
FROM `propriedade`
LEFT JOIN organizacao ON organizacao.id = propriedade.opm_id
LEFT JOIN view_crpm ON view_crpm.id= organizacao.id_superior
LEFT JOIN municipio ON municipio.codigo_ibge = propriedade.id_cidade WHERE propriedade.id = " . $id);


        $this->id = $obj[0]->id;
        $this->id_atividade = $obj[0]->id_atividade;
        $this->nome = $obj[0]->nome;
        $this->lat = $obj[0]->lat;
        $this->log = $obj[0]->log;
        $this->nr_propriedade = $obj[0]->nr_propriedade;
        $this->referencia = $obj[0]->referencia;
        $this->id_cidade = $obj[0]->id_cidade;
        $this->zona_rural = $obj[0]->zona_rural;
        $this->cod_propriedade = $obj[0]->cod_propriedade;
        $this->opm_id = $obj[0]->opm_id;
        $this->senhawifi = $obj[0]->senhawifi;
        $this->redewifi = $obj[0]->redewifi;
        $this->nome_cidade = $obj[0]->nome_cidade;
        $this->crpm_id = $obj[0]->crpm_id;
        $this->defensivo = $obj[0]->defensivo;
        $this->def_mes_ini = $obj[0]->def_mes_ini;
        $this->def_mes_fim = $obj[0]->def_mes_fim;
        $this->tipoprop = $obj[0]->tipoprop;

        // unset($obj);
        return $this;
    }

    public function getNomeCidade() {
        return $this->nome_cidade;
    }

    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'propriedade';
    }

    public function pegaCidade() {
        if ($this->id_cidade == '') {

            $json = file_get_contents("https://nominatim.openstreetmap.org/reverse?lat={$this->lat}&lon={$this->log}&format=json");
            echo $json;
            $dados = json_decode($json);
            return $dados;
        }
    }

    public function getTipoprop() {
        return $this->tipoprop;
    }

    public function setTipoprop($tipoprop) {
        $this->tipoprop = $tipoprop;
        return $this;
    }

    public function getJsObject() {
        $Object = "{id:\"{$this->id}\""
                . ",id_atividade:\"{$this->id_atividade}\""
                . ",nome:\"{$this->nome}\""
                . ",lat:\"{$this->lat}\""
                . ",log:\"{$this->log}\""
                . ",nr_propriedade:\"{$this->nr_propriedade}\""
                . ",referencia:\"{$this->referencia}\""
                . ",id_cidade:\"{$this->id_cidade}\""
                . ",nome_cidade:\"{$this->nome_cidade}\""
                . ",zona_rural:\"{$this->zona_rural}\""
                . ",redewifi:\"{$this->redewifi}\""
                . ",senhawifi:\"{$this->senhawifi}\""
                . ",crpm_id:\"{$this->crpm_id}\""
                . ",opm_id:\"{$this->opm_id}\""
                . ",defensivo:\"{$this->defensivo}\""
                . ",def_mes_ini:\"{$this->def_mes_ini}\""
                . ",def_mes_fim:\"{$this->def_mes_fim}\""
                . ",tipoprop:\"{$this->tipoprop}\""
                . ",cod_propriedade:\"{$this->cod_propriedade}\"}";
        return $Object;
    }

}
