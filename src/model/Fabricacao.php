<?php

class Fabricacao {
    private $idfabricacao;
    private $ano;

    public function __construct($idfabricacao, $ano) {
        $this->idfabricacao = $idfabricacao;
        $this->ano = $ano;  
    }

    
	public function getIdfabricacao(){
		return $this->idfabricacao;
	}

	public function setIdfabricacao($idfabricacao){
		$this->idfabricacao = $idfabricacao;
	}

	public function getAno(){
		return $this->ano;
	}

	public function setAno($ano){
		$this->ano = $ano;
	}
}