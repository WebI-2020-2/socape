<?php

class Entrada
{
    private $identrada;
    private $idfornecedor;
    private $valortotalnota;
    private $datacompra;
    private $status;

    public function __construct($identrada, $idfornecedor, $valortotalnota, $datacompra, $status)
    {
        $this->identrada = $identrada;
        $this->idfornecedor = $idfornecedor;
        $this->valortotalnota = $valortotalnota;
        $this->datacompra = $datacompra;
        $this->status = $status;
    }

    public function getIdentrada()
    {
        return $this->identrada;
    }

    public function setIdentrada($identrada)
    {
        $this->identrada = $identrada;
    }

    public function getIdfornecedor()
    {
        return $this->idfornecedor;
    }

    public function setIdfornecedor($idfornecedor)
    {
        $this->idfornecedor = $idfornecedor;
    }

    public function getValortotalnota()
    {
        return $this->valortotalnota;
    }

    public function setValortotalnota($valortotalnota)
    {
        $this->valortotalnota = $valortotalnota;
    }

    public function getDatacompra()
    {
        return $this->datacompra;
    }

    public function setDatacompra($datacompra)
    {
        $this->datacompra = $datacompra;
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
