<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fachada
 *
 * @author richard
 */
class Fachada {

    private $id;
    private $propriedade_id;
    private $foto;

    //put your code here


    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'prop_fachada';
    }

    public function getNameId() {
        return 'id';
    }

    public function getId() {
        return $this->id;
    }

    public function getPropriedade_id() {
        return $this->propriedade_id;
    }

    public function getFoto() {
        return $this->foto;
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

    public function setFachada($dados) {
        if (is_object($dados)) {
            $this->id = $dados->id;
            $this->propriedade_id = $dados->propriedade_id;
            $this->foto = $dados->foto;
        } else {
            $this->id = $dados['id'];
            $this->propriedade_id = $dados['propriedade_id'];
            $this->foto = $dados['foto'];
        }
    }

}
