<?php

class ItensVenda
{
    private $iditensvenda;
    private $idproduto;
    private $idvenda;
    private $quantidade;
    private $valorvenda;
    private $desconto;
    private $lucro;

    public function __construct($iditensvenda, $idproduto, $idvenda, $quantidade, $valorvenda, $desconto, $lucro)
    {
        $this->iditensvenda = $iditensvenda;
        $this->idproduto = $idproduto;
        $this->idvenda = $idvenda;
        $this->quantidade = $quantidade;
        $this->valorvenda = $valorvenda;
        $this->desconto = $desconto;
        $this->lucro = $lucro;
    }

    public function getIditensvenda()
    {
        return $this->iditensvenda;
    }

    public function setIditensvenda($iditensvenda)
    {
        $this->iditensvenda = $iditensvenda;
    }

    public function getIdproduto()
    {
        return $this->idproduto;
    }

    public function setIdproduto($idproduto)
    {
        $this->idproduto = $idproduto;
    }

    public function getIdvenda()
    {
        return $this->idvenda;
    }

    public function setIdvenda($idvenda)
    {
        $this->idvenda = $idvenda;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getValorvenda()
    {
        return $this->valorvenda;
    }

    public function setValorvenda($valorvenda)
    {
        $this->valorvenda = $valorvenda;
    }

    public function getDesconto()
    {
        return $this->desconto;
    }

    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }

    public function getLucro()
    {
        return $this->lucro;
    }

    public function setLucro($lucro)
    {
        $this->lucro = $lucro;
    }
}
