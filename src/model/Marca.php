<?php

class Marca {
    private $idmarca;
    private $marca;

    public function __construct($idmarca, $marca) {
        $this->idmarca = $idmarca;
        $this->marca = $marca;  
    }

    
	public function getIdmarca(){
		return $this->idmarca;
	}

	public function setIdmarca($idmarca){
		$this->idmarca = $idmarca;
	}

	public function getMarca(){
		return $this->marca;
	}

	public function setMarca($marca){
		$this->marca = $marca;
	}
}