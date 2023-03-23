<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MaqEquip
 *
 * @author richard
 */
class MaqEquip {

    private $id,
            $propriedade_id,
            $categoria,
            $foto,
            $chassi,
            $marca,
            $modelo,
            $descricao;

//put your code here
    public function getId() {
        return $this->id;
    }

    public function getPropriedade_id() {
        return $this->propriedade_id;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getChassi() {
        return $this->chassi;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPropriedade_id($propriedade_id) {
        $this->propriedade_id = $propriedade_id;
        return $this;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
        return $this;
    }

    public function setChassi($chassi) {
        $this->chassi = $chassi;
        return $this;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'prop_maqequip';
    }

    public function getNameId() {
        return 'id';
    }

    public function setMaqEquip($param) {
        if (is_array($param)) {
            $this->id = $param['id'];
            $this->propriedade_id = $param['propriedade_id'];
            $this->foto = $param['foto'];
            $this->chassi = $param['chassi'];
            $this->categoria = $param['categoria'];
            $this->marca = $param['marca'];
            $this->modelo = $param['modelo'];
            $this->descricao = $param['descricao'];
        } else {
            $this->id = $param->id;
            $this->propriedade_id = $param->propriedade_id;
            $this->foto = $param->foto;
            $this->chassi = $param->chassi;
            $this->categoria = $param->categoria;
            $this->marca = $param->marca;
            $this->modelo = $param->modelo;
            $this->descricao = $param->descricao;
        }
    }

}
