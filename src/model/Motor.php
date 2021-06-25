<?php

class Motor {
    private $idmotor;
    private $potencia;



    public function __construct($idmotor, $potencia) {
        $this->idmotor = $idmotor;
        $this->potencia = $potencia;  
    }

    
	public function getIdmotor(){
		return $this->idmotor;
	}

	public function setIdmotor($idmotor){
		$this->idmotor = $idmotor;
	}

	public function getPotencia(){
		return $this->potencia;
	}

	public function setPotencia($potencia){
		$this->potencia = $potencia;
	}
}