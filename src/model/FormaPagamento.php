<?php

class FormaPagamento {
    private $idformapagamento;
    private $condicao;
    private $forma;

    public function __construct($idformapagamento, $condicao, $forma) {
        $this->idformapagamento = $idformapagamento;
        $this->condicao = $condicao;  
        $this->forma = $forma;  
    }

  public function getIdformapagamento(){
		return $this->idformapagamento;
	}

	public function setIdformapagamento($idformapagamento){
		$this->idformapagamento = $idformapagamento;
	}

	public function getCondicao(){
		return $this->condicao;
	}

	public function setCondicao($condicao){
		$this->condicao = $condicao;
	}

	public function getForma(){
		return $this->forma;
	}

	public function setForma($forma){
		$this->forma = $forma;
	}
}