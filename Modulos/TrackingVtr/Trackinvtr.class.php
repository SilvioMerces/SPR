<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trackinvtr
 *
 * @author richard
 */


class Trackinvtr {

    private $id;
    private $prefixo;
    private $nrfone;
    private $latitude;
    private $longitude;
    private $dt;

    //put your code here
    function __construct($prefixo, $latitude, $longitude,$dth,$nrfone) {
        $this->prefixo = $prefixo;
        $this->nrfone = $nrfone;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->dth = $dth;
    }

    private function setId($param) {
        $this->id = $param;
    }

    function AddTracking() {
        $db = new Conect;
        $this->setId($db->AddObjeto($this));
    }

    function getLastPosition() {
        $lastpost = $db->Sql("SELECT * FROM trackingvtr WHERE prefixo = {$this->prefixo} order by dth desc limit 1;");
        return $lastpost[0];
    }

    public function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'trackingvtr';
    }

    public function getNameId() {
        return 'id';
    }

    public function getId() {
        return $this->id;
    }

}
