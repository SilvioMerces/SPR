<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author richard
 */

require_once '../../../Libs/php/Conect.class.php';
require_once '../../../Libs/php/DBTable.php';

class User extends DBTable {
    
    
    private $id;
    private $login;
    private $pwd;
    private $cpf;
    private $ativo;
    private $perfil;
    //put your code here
    
    public function getPropriedades() {
        return get_object_vars($this);
    }
    public function getTable() {
        return "usuario";
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
        return $this;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
        return $this;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
        return $this;
    }
    
    public function Add(){
       $db = new Conect();
       
       $db->AddObjeto($this);
       
    }
}
