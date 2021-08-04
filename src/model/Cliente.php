<?php

class Cliente
{
    private $idcliente;
    private $nome;
    private $telefone;
    private $cnpj;
    private $cpf;
    private $debito;

    public function __construct($idcliente, $nome, $telefone, $cnpj, $cpf, $debito)
    {
        $this->idcliente = $idcliente;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->cnpj = $cnpj;
        $this->cpf = $cpf;
        $this->debito = $debito;
    }

    public function getIdcliente()
    {
        return $this->idcliente;
    }

    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getDebito()
    {
        return $this->debito;
    }

    public function setDebito($debito)
    {
        $this->debito = $debito;
    }
}
