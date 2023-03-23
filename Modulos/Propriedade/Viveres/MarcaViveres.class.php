<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MarcaViveres
 *
 * @author richard
 */
class MarcaViveres {

    private $id,
            $foto,
            $propriedade_id,
            $descricao;

    //put your code here
    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'prop_marcaviveres';
    }

    public function getNameId() {
        return 'id';
    }

    public function getId() {
        return $this->id;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getPropriedade_id() {
        return $this->propriedade_id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    public function setPropriedade_id($propriedade_id) {
        $this->propriedade_id = $propriedade_id;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setMarcaViveres($param) {
        if (is_array($param)) {
            $this->id = $param['id'];
            $this->foto = $param['foto'];
            $this->propriedade_id = $param['propriedade_id'];
            $this->descricao = $param['descricao'];
        } else {
            $this->id = $param->id;
            $this->foto = $param->foto;
            $this->propriedade_id = $param->propriedade_id;
            $this->descricao = $param->descricao;
        }
    }

}
