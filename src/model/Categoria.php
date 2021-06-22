<?php

class Categoria {
    private $idcategoria;
    private $categoria;
 
    
    public function __construct($idcategoria, $categoria) { 
        $this->idcategoria = $idcategoria;
        $this->categoria = $categoria;        
    }

    
    public function getIdcategoria(){
		return $this->idcategoria;
	}

	public function setIdcategoria($idcategoria){
		$this->idcategoria = $idcategoria;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
}