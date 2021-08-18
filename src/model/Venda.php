<?php

class Venda
{
    private $idvenda;
    private $idcliente;
    private $idformapagamento;
    private $data;
    private $valortotal;
    private $status;

    public function __construct($idvenda, $idcliente, $idformapagamento, $data, $valortotal, $status)
    {
        $this->idvenda = $idvenda;
        $this->idcliente = $idcliente;
        $this->idformapagamento = $idformapagamento;
        $this->data = $data;
        $this->valortotal = $valortotal;
        $this->status = $status;
    }

    public function getIdvenda()
    {
        return $this->idvenda;
    }

    public function setIdvenda($idvenda)
    {
        $this->idvenda = $idvenda;
    }

    public function getIdcliente()
    {
        return $this->idcliente;
    }

    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;
    }

    public function getIdformapagamento()
    {
        return $this->idformapagamento;
    }

    public function setIdformapagamento($idformapagamento)
    {
        $this->idformapagamento = $idformapagamento;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getValortotal()
    {
        return $this->valortotal;
    }

    public function setValortotal($valortotal)
    {
        $this->valortotal = $valortotal;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
