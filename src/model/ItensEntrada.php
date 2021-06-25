<?php

class ItensEntrada {
    private $iditensentrada;
    private $identrada;
    private $idproduto;
    private $precocompra;
    private $quantidade;
    private $unidade;
    private $ipi;
    private $frete;
    private $icms;



    public function __construct($iditensentrada, $identrada, $idproduto, $precocompra, $quantidade, $unidade, $ipi, $frete, $icms) {
        $this->iditensentrada = $iditensentrada;
        $this->identrada = $identrada;
        $this->idproduto = $idproduto;
        $this->precocompra = $precocompra;
        $this->quantidade = $quantidade;
        $this->unidade = $unidade;
        $this->ipi = $ipi;
        $this->frete = $frete;
        $this->icms = $icms;
    }


	public function getIditensentrada(){
		return $this->iditensentrada;
	}

	public function setIditensentrada($iditensentrada){
		$this->iditensentrada = $iditensentrada;
	}

	public function getIdentrada(){
		return $this->identrada;
	}

	public function setIdentrada($identrada){
		$this->identrada = $identrada;
	}

	public function getIdproduto(){
		return $this->idproduto;
	}

	public function setIdproduto($idproduto){
		$this->idproduto = $idproduto;
	}

	public function getPrecocompra(){
		return $this->precocompra;
	}

	public function setPrecocompra($precocompra){
		$this->precocompra = $precocompra;
	}

	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}

	public function getUnidade(){
		return $this->unidade;
	}

	public function setUnidade($unidade){
		$this->unidade = $unidade;
	}

	public function getIpi(){
		return $this->ipi;
	}

	public function setIpi($ipi){
		$this->ipi = $ipi;
	}

	public function getFrete(){
		return $this->frete;
	}

	public function setFrete($frete){
		$this->frete = $frete;
	}

	public function getIcms(){
		return $this->icms;
	}

	public function setIcms($icms){
		$this->icms = $icms;
	}
}