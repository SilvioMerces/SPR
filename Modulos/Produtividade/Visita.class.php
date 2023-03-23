<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Monitoramento
 *
 * @author richard
 */
require_once '../../Libs/php/Conect.class.php';

class Visita { 

    private $id;
    private $municipio;
    private $pref_vtr;
    private $cod_propriedade;
    private $tipo; /* 20580 = monitoramento; 30187 = Visita Comunitária Rural; 30176 = Visita Solidaria */
    private $nome_propriedade;
    private $nome;
    private $rg;
    private $cpf;
    private $datnas;
    private $telefone;
    private $tipo_local;
    private $tipo_especifico_local;
    private $lat;
    private $log;
    private $obs;
    private $foto;
    private $datavisita;

    //put your code here

    function getNome_propriedade() {
        return $this->nome_propriedade;
    }

    function getCod_propriedade() {
        return $this->cod_propriedade;
    }

    function setNome_propriedade($nome_propriedade): void {
        $this->nome_propriedade = $nome_propriedade;
    }

    function setCod_propriedade($cod_propriedade): void {
        $this->cod_propriedade = $cod_propriedade;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getDatnas() {
        return $this->datnas;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getTipo_local() {
        return $this->tipo_local;
    }

    public function getTipo_especifico_local() {
        return $this->tipo_especifico_local;
    }

    public function getMunicipio() {
        return $this->municipio;
    }

    public function getLat() {
        return $this->lat;
    }

    public function getLon() {
        return $this->lon;
    }


    public function getObs() {
        return $this->obs;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setRg($rg) {
        $this->rg = $rg;
        return $this;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function setDatnas($datnas) {
        $this->datnas = $datnas;
        return $this;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
        return $this;
    }

    public function setTipo_local($tipo_local) {
        $this->tipo_local = $tipo_local;
        return $this;
    }

    public function setTipo_especifico_local($tipo_espcifico_local) {
        $this->tipo_espcifico_local = $tipo_espcifico_local;
        return $this;
    }

    public function setMunicipio($municipio) {
        $this->municipio = $municipio;
        return $this;
    }

    public function setLat($lat) {
        $this->lat = $lat;
        return $this;
    }

    public function setLon($lon) {
        $this->lon = $lon;
        return $this;
    }
    public function setObs($obs) {
        $this->obs = $obs;
        return $this;
    }

    public function getDataVisita() {
        return $this->datavisita;
    }

    public function setDataVisita($dataVisita) {
        $this->datavisita = $dataVisita;
        return $this;
    }

    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'produtividade';
    }

    public function getNameId() {
        return 'id';
    }

    public function setVisita($dados) {
        $objvars = $this->getPropiedades();
        
        if (is_object($dados)) {
            foreach ($objvars as $key => $vl) {
                echo $key;
                if ($vl != '') {
                    $this->$key = $dados->$key;
                }
            }
        } else {

            foreach ($objvars as $key => $vl) {
                if ($dados[$key] != '') {
                    $this->$key = $dados[$key];
                }
            }
        }
    }

    public function getVisitas($tipo = 0) {
        $tipo == 0 ? $sql = "SELECT * FROM " . $this->getTabela() . ";" : $sql = "SELECT * FROM " . $this->getTabela() . " WHERE tipo=$tipo order by datavisita desc;";
        $db = new Conect;
        return $db->Sql($sql);
        unset($db);
    }
    
    function getPref_vtr() {
        return $this->pref_vtr;
    }

    function setPref_vtr($pref_vtr): void {
        $this->pref_vtr = $pref_vtr;
    }
    
    function AddVisita(){
        $db = new Conect;
        $this->setId($db->AddObjeto($this));

        move_uploaded_file ( $this->getFoto(), "/spr_files/visita_".$this->getId().".png" );
        
    }


}
