<?php

class Valvulas
{
    private $idvalvulas;
    private $quantidade;

    public function __construct($idvalvulas, $quantidade)
    {
        $this->idvalvulas = $idvalvulas;
        $this->quantidade = $quantidade;
    }

    public function getIdvalvulas()
    {
        return $this->idvalvulas;
    }

    public function setIdvalvulas($idvalvulas)
    {
        $this->idvalvulas = $idvalvulas;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }
}
