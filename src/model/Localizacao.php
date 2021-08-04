<?php

class Localizacao
{
    private $idlocalizacao;
    private $departamento;

    public function __construct($idlocalizacao, $departamento)
    {
        $this->idlocalizacao = $idlocalizacao;
        $this->departamento = $departamento;
    }

    public function getIdlocalizacao()
    {
        return $this->idlocalizacao;
    }

    public function setIdlocalizacao($idlocalizacao)
    {
        $this->idlocalizacao = $idlocalizacao;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }
}
