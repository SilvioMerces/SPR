<?php
require_once '../Libs/php/Conect.class.php';

$db = new Conect;

class EntradaServico {

    private $id;
    private $prefixo;
    private $entrada;
    private $saida;
    private $cmdt;
    private $motorista;
    private $homem3;
    private $homem4;
    private $homem5;

    public function __construct($dados) {

        $this->prefixo = $dados['prefixo'];
        $this->entrada = $dados['entrada'];
        $this->saida = $dados['saida'];
        $this->cmdt = $dados['cmdt'];
        $this->motorista = $dados['motorista'];
        $this->homem3 = $dados['homem3'];
        $this->homem4 = $dados['homem4'];
        $this->homem5 = $dados['homem5'];
    }

    function getId() {
        return $this->id;
    }

    function getPrefixo() {
        return $this->prefixo;
    }

    function getEntrada() {
        return $this->entrada;
    }

    function getSaida() {
        return $this->saida;
    }

    function getCmdt() {
        return $this->cmdt;
    }

    function getMotorista() {
        return $this->motorista;
    }

    function getHomem3() {
        return $this->homem3;
    }

    function getHomem4() {
        return $this->homem4;
    }

    function getHomem5() {
        return $this->homem5;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setPrefixo($prefixo): void {
        $this->prefixo = $prefixo;
    }

    function setEntrada($entrada): void {
        $this->entrada = $entrada;
    }

    function setSaida($saida): void {
        $this->saida = $saida;
    }

    function setCmdt($cmdt): void {
        $this->cmdt = $cmdt;
    }

    function setMotorista($motorista): void {
        $this->motorista = $motorista;
    }

    function setHomem3($homem3): void {
        $this->homem3 = $homem3;
    }

    function setHomem4($homem4): void {
        $this->homem4 = $homem4;
    }

    function setHomem5($homem5): void {
        $this->homem5 = $homem5;
    }

    function getPropiedades() {
        return get_object_vars($this);
    }

    public function getTabela() {
        return 'servico';
    }

    public function getNameId() {
        return 'id';
    }

}

$serv = new EntradaServico($_REQUEST);
//echo '<pre>';
//print_r($serv);
$db->AddObjeto($serv);
