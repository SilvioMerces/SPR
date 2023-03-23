<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Colaborador
 *
 * @author richard
 */
class Colaborador {

    private $id; //	integer 	NOT NULL	nextval('colaborador_id_seq'::regclass) 	[pk] 	Browse 	Alter 	Privileges 	Drop 	
    private $id_propriedade; // 	integer 	NOT NULL		[fk] 	Browse 	Alter 	Privileges 	Drop 	
    private $nome; // 	character varying(60) 	NOT NULL			Browse 	Alter 	Privileges 	Drop 	
    private $cpf; // 	character varying(17) 	NOT NULL			Browse 	Alter 	Privileges 	Drop 	
    private $rg; // 	character varying(30) 	NOT NULL			Browse 	Alter 	Privileges 	Drop 	
    private $sexo; // 	integer 			[fk] 	Browse 	Alter 	Privileges 	Drop 	
    private $tipopess; // 	integer 			[fk] 	Browse 	Alter 	Privileges 	Drop 	
    private $naturalidade; // 	character varying(60) 				Browse 	Alter 	Privileges 	Drop 	
    private $pai; // 	character varying(60) 				Browse 	Alter 	Privileges 	Drop 	
    private $mae; // 	character varying(60) 				Browse 	Alter 	Privileges 	Drop 	
    private $dn; // 	character varying(10) 				Browse 	Alter 	Privileges 	Drop 	
    private $foto; //

    //put your code here

    public function __construct($dados = null) {
        if (!is_null($dados)) {
            $this->id = $dados['id'];
            $this->id_propriedade = $dados['id_propriedade'];
            $this->nome = $dados['nome'];
            $this->cpf = $dados['cpf'];
            $this->rg = $dados['rg'];
            $this->sexo = $dados['sexo'];
            $this->tipopess = $dados['tipopess'];
            $this->naturalidade = $dados['naturalidade'];
            $this->pai = $dados['pai'];
            $this->mae = $dados['mae'];
            $this->dn = $dados['dn'];
            $this->foto = $dados['foto'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getId_propriedade() {
        return $this->id_propriedade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getTipopess() {
        return $this->tipopess;
    }

    public function getNaturalidade() {
        return $this->naturalidade;
    }

    public function getPai() {
        return $this->pai;
    }

    public function getMae() {
        return $this->mae;
    }

    public function getDn() {
        return $this->dn;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_propriedade($id_propriedade) {
        $this->id_propriedade = $id_propriedade;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setTipopess($tipopess) {
        $this->tipopess = $tipopess;
    }

    public function setNaturalidade($naturalidade) {
        $this->naturalidade = $naturalidade;
    }

    public function setPai($pai) {
        $this->pai = $pai;
    }

    public function setMae($mae) {
        $this->mae = $mae;
    }

    public function setDn($dn) {
        $this->dn = $dn;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setColaborador($colab) {
        $self = get_object_vars($this);
        foreach ($self as $key => $value) {
            $this->$key = $colab->$key;
        }
        return $this;
    }

    public function getPropiedades() {
        return get_object_vars($this);
    }
    
    public function getTabela(){
        return 'colaborador';
    }
    
    public function getNameId(){
        return 'id';
    }

}
