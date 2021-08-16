<?php

class Produto
{
    private $idproduto;
    private $idmotor;
    private $idcarro;
    private $idvalvulas;
    private $idfabricacao;
    private $idcategoria;
    private $idmarca;
    private $icms;
    private $ipi;
    private $frete;
    private $valornafabrica;
    private $valordecompra;
    private $lucro;
    private $valorvenda;
    private $desconto;
    private $quantidade;
    private $unidade;
    private $idlocalizacao;
    private $referencia;
    private $descricao;

    public function __construct($idproduto, $idmotor, $idcarro, $idvalvulas, $idfabricacao, $idcategoria, $idmarca, $icms, $ipi, $frete, $valornafabrica, $valordecompra, $lucro, $valorvenda, $desconto, $quantidade, $unidade, $idlocalizacao, $referencia, $descricao)
    {
        $this->idproduto = $idproduto;
        $this->idmotor = $idmotor;
        $this->idcarro = $idcarro;
        $this->idvalvulas = $idvalvulas;
        $this->idfabricacao = $idfabricacao;
        $this->idcategoria = $idcategoria;
        $this->idmarca = $idmarca;
        $this->icms = $icms;
        $this->ipi = $ipi;
        $this->frete = $frete;
        $this->valornafabrica = $valornafabrica;
        $this->valordecompra = $valordecompra;
        $this->lucro = $lucro;
        $this->valorvenda = $valorvenda;
        $this->desconto = $desconto;
        $this->quantidade = $quantidade;
        $this->unidade = $unidade;
        $this->idlocalizacao = $idlocalizacao;
        $this->referencia = $referencia;
        $this->descricao = $descricao;
    }

    public function getIdproduto()
    {
        return $this->idproduto;
    }

    public function setIdproduto($idproduto)
    {
        $this->idproduto = $idproduto;
    }

    public function getIdmotor()
    {
        return $this->idmotor;
    }

    public function setIdmotor($idmotor)
    {
        $this->idmotor = $idmotor;
    }

    public function getIdcarro()
    {
        return $this->idcarro;
    }

    public function setIdcarro($idcarro)
    {
        $this->idcarro = $idcarro;
    }

    public function getIdvalvulas()
    {
        return $this->idvalvulas;
    }

    public function setIdvalvulas($idvalvulas)
    {
        $this->idvalvulas = $idvalvulas;
    }

    public function getIdfabricacao()
    {
        return $this->idfabricacao;
    }

    public function setIdfabricacao($idfabricacao)
    {
        $this->idfabricacao = $idfabricacao;
    }

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    public function getIdmarca()
    {
        return $this->idmarca;
    }

    public function setIdmarca($idmarca)
    {
        $this->idmarca = $idmarca;
    }

    public function getIcms()
    {
        return $this->icms;
    }

    public function setIcms($icms)
    {
        $this->icms = $icms;
    }

    public function getIpi()
    {
        return $this->ipi;
    }

    public function setIpi($ipi)
    {
        $this->ipi = $ipi;
    }

    public function getFrete()
    {
        return $this->frete;
    }

    public function setFrete($frete)
    {
        $this->frete = $frete;
    }

    public function getValornafabrica()
    {
        return $this->valornafabrica;
    }

    public function setValornafabrica($valornafabrica)
    {
        $this->valornafabrica = $valornafabrica;
    }

    public function getValordecompra()
    {
        return $this->valordecompra;
    }

    public function setValordecompra($valordecompra)
    {
        $this->valordecompra = $valordecompra;
    }

    public function getLucro()
    {
        return $this->lucro;
    }

    public function setLucro($lucro)
    {
        $this->lucro = $lucro;
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

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    }

    public function getIdlocalizacao()
    {
        return $this->idlocalizacao;
    }

    public function setIdlocalizacao($idlocalizacao)
    {
        $this->idlocalizacao = $idlocalizacao;
    }

    public function getReferencia()
    {
        return $this->referencia;
    }

    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    
}
