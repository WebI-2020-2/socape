<?php

class Carro
{
    private $idcarro;
    private $modelo;

    public function __construct($idcarro, $modelo)
    {
        $this->idcarro = $idcarro;
        $this->modelo = $modelo;
    }

    public function getIdcarro()
    {
        return $this->idcarro;
    }

    public function setIdcarro($idcarro)
    {
        $this->idcarro = $idcarro;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }
}
