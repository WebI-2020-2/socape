<?php

class Fornecedor {
    private $idfornecedor;
    private $nome;
    private $endereco;
    private $telefone;
    private $cnpj;

    public function __construct($idfornecedor, $nome, $endereco, $telefone, $cnpj) {
        $this->idfornecedor = $idfornecedor;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->cnpj = $cnpj;
    }


	public function getIdfornecedor(){
		return $this->idfornecedor;
	}

	public function setIdfornecedor($idfornecedor){
		$this->idfornecedor = $idfornecedor;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getCnpj(){
		return $this->cnpj;
	}

	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}
}