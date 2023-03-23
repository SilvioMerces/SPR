<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produtividade
 *
 * @author richard
 */
 
include_once '../../Libs/php/Conect.class.php';

class Produtividade extends Conect {
    //put your code here
    private $id;
    private $id_propriedade;
    private $pref_vtr;
    private $opm_id;
    private $cidade_id;
    private $obs;
    private $data;
    private $tipo;
    private $nome_propriedade;
    private $nome;
    private $rg;
    private $cpf ;
    private $dataf ;
    private $telefone;
    private $tipo_local;
    private $tipo_especifico_local;
    private $latitude;
    private $longitude;
    private $datavisita;
    
    public function __construct($dados) {
       foreach ($dados as $key => $valor) {
            $this->$key = $valor;
        }
    }
    
    public function addProdutividade(){
        $con = new Conect();
        $this->id=null;
        $con->AddObjeto($this);
    }
    
     public function getPropiedades() {
        return get_object_vars($this);
    }
    
    public function getTabela(){
        return 'produtividade';
    }
    
    public function getNameId(){
        return 'id';
    }
    
    function getId() {
        return $this->id;
    }

    function getId_propriedade() {
        return $this->id_propriedade;
    }

    function getPref_vtr() {
        return $this->pref_vtr;
    }

    function getOpm_id() {
        return $this->opm_id;
    }

    function getCidade_id() {
        return $this->cidade_id;
    }

    function getObs() {
        return $this->obs;
    }

    function getData() {
        return $this->data;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getNome_propriedade() {
        return $this->nome_propriedade;
    }

    function getNome() {
        return $this->nome;
    }

    function getRg() {
        return $this->rg;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDatanas() {
        return $this->datanas;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getTipo_local() {
        return $this->tipo_local;
    }

    function getTipo_especifico_local() {
        return $this->tipo_especifico_local;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getDatavisita() {
        return $this->datavisita;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setId_propriedade($id_propriedade): void {
        $this->id_propriedade = $id_propriedade;
    }

    function setPref_vtr($pref_vtr): void {
        $this->pref_vtr = $pref_vtr;
    }

    function setOpm_id($opm_id): void {
        $this->opm_id = $opm_id;
    }

    function setCidade_id($cidade_id): void {
        $this->cidade_id = $cidade_id;
    }

    function setObs($obs): void {
        $this->obs = $obs;
    }

    function setData($data): void {
        $this->data = $data;
    }

    function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    function setNome_propriedade($nome_propriedade): void {
        $this->nome_propriedade = $nome_propriedade;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setRg($rg): void {
        $this->rg = $rg;
    }

    function setCpf($cpf): void {
        $this->cpf = $cpf;
    }

    function setDatanas($dataanas): void {
        $this->datanas = $datanas;
    }

    function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }

    function setTipo_local($tipo_local): void {
        $this->tipo_local = $tipo_local;
    }

    function setTipo_especifico_local($tipo_especifico_local): void {
        $this->tipo_especifico_local = $tipo_especifico_local;
    }

    function setLatitude($latitude): void {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude): void {
        $this->longitude = $longitude;
    }

    function setDatavisita($datavisita): void {
        $this->datavisita = $datavisita;
    }
        
    function setDados($dados){
        
        foreach ($dados as $key => $valor) {
            $this->$key = $valor;
        }
    }

}
