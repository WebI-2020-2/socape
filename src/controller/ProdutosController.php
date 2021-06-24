<?php

require_once '../../model/Produto.php';
require_once '../../model/Database.php';

class ProdutosController extends Produto
{
    protected $tabela = 'produto';

    public function __construct()
    {
    }

    public function findOne($idproduto)
    {
        $query = "SELECT * FROM $this->tabela WHERE idproduto = :idproduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $produto->setIdproduto($obj->idproduto);
            $produto->setIdmotor($obj->idmotor);
            $produto->setIdcarro($obj->idcarro);
            $produto->setIdvalvulas($obj->idvalvulas);
            $produto->setIdfabricacao($obj->idfabricacao);
            $produto->setIdcategoria($obj->idcategoria);
            $produto->setIdmarca($obj->idmarca);
            $produto->setIcms($obj->icms);
            $produto->setIpi($obj->ipi);
            $produto->setFrete($obj->frete);
            $produto->setValorfabrica($obj->valorfabrica);
            $produto->setValordecompra($obj->valordecompra);
            $produto->setLucro($obj->lucro);
            $produto->setValorvenda($obj->valorvenda);
            $produto->setDesconto($obj->desconto);
            $produto->setQuantidade($obj->quantidade);
            $produto->setUnidade($obj->unidade);
            $produto->setIdlocalizacao($obj->idlocalizacao);
            $produto->setReferencia($obj->referencia);
        }
        return $produto;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $produtos = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $produtos,
                new Produto(
                    $obj->idproduto,
                    $obj->idmotor,
                    $obj->idcarro,
                    $obj->idvalvulas,
                    $obj->idfabricacao,
                    $obj->idcategoria,
                    $obj->idmarca,
                    $obj->icms,
                    $obj->ipi,
                    $obj->frete,
                    $obj->valorfabrica,
                    $obj->valordecompra,
                    $obj->lucro,
                    $obj->valorvenda,
                    $obj->desconto,
                    $obj->quantidade,
                    $obj->unidade,
                    $obj->idlocalizacao,
                    $obj->referencia
                )
            );
        }
        return $produtos;
    }

    public function insert($idmotor, $idcarro, $idvalvulas, $idfabricacao, $idcategoria, $idmarca, $icms, $ipi, $frete, $valorfabrica, $valordecompra, $lucro, $valorvenda, $desconto, $quantidade, $unidade, $idlocalizacao, $referencia)
    {
        $query = "INSERT INTO $this->tabela (idmotor, idcarro, idvalvulas, idfabricacao, idcategoria, idmarca, icms, ipi, frete, 
        valorfabrica, valordecompra, lucro, valorvenda, desconto, quantidade, unidade, idlocalizacao, referencia)
        VALUES (:idmotor, :idcarro, :idvalvulas, :idfabricacao, :idcategoria, :idmarca, :icms, :ipi, :frete, :valorfabrica, 
        :valordecompra, :lucro, :valorvenda, :desconto, :quantidade, :unidade, :idlocalizacao,: referencia)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmotor', $idmotor);
        $stm->bindParam(':idcarro', $idcarro);
        $stm->bindParam(':idvalvulas', $idvalvulas);
        $stm->bindParam(':idfabricacao', $idfabricacao);
        $stm->bindParam(':idcategoria', $idcategoria);
        $stm->bindParam(':idmarca', $idmarca);
        $stm->bindParam(':icms', $icms);
        $stm->bindParam(':ipi', $ipi);
        $stm->bindParam(':frete', $frete);
        $stm->bindParam(':valorfabrica', $valorfabrica);
        $stm->bindParam(':valordecompra', $valordecompra);
        $stm->bindParam(':lucro', $lucro);
        $stm->bindParam(':valorvenda', $valorvenda);
        $stm->bindParam(':desconto', $desconto);
        $stm->bindParam(':quantidade', $quantidade);
        $stm->bindParam(':unidade', $unidade);
        $stm->bindParam(':idlocalizacao', $idlocalizacao);
        $stm->bindParam(':referencia', $referencia);
        return $stm->execute();
    }

    public function update($idproduto)
    {
        $query = "UPDATE $this->tabela SET idmotor = :idmotor, idcarro = :idcarro, idvalvulas = :idvalvulas, idfabricacao = :idfabricacao, idcategoria = :idcategoria, 
        idmarca = :idmarca, icms = :icms, ipi = :ipi, frete = :frete, valorfabrica = :valorfabrica, valordecompra = :valordecompra, 
        lucro = :lucro, valorvenda = :valorvenda, desconto = :desconto, quantidade = :quantidade, unidade = :unidade, 
        idlocalizacao = :idlocalizacao, referencia = :referencia WHERE idproduto = :idproduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        $stm->bindValue(':idmotor', $this->getIdmotor());
        $stm->bindValue(':idcarro', $this->getIdcarro());
        $stm->bindValue(':idvalvulas', $this->getIdvalvulas());
        $stm->bindValue(':idfabricacao', $this->getIdfabricacao());
        $stm->bindValue(':idcategoria', $this->getIdcategoria());
        $stm->bindValue(':idmarca', $this->getIdmarca());
        $stm->bindValue(':icms', $this->getIcms());
        $stm->bindValue(':ipi', $this->getIpi());
        $stm->bindValue(':frete', $this->getFrete());
        $stm->bindValue(':valorfabrica', $this->getValorfabrica());
        $stm->bindValue(':valordecompra', $this->getValordecompra());
        $stm->bindValue(':lucro', $this->getLucro());
        $stm->bindValue(':valorvenda', $this->getValorvenda());
        $stm->bindValue(':desconto', $this->getDesconto());
        $stm->bindValue(':quantidade', $this->getQuantidade());
        $stm->bindValue(':unidade', $this->getUnidade());
        $stm->bindValue(':idlocalizacao', $this->getIdlocalizacao());
        $stm->bindValue(':referencia', $this->getReferencia());
        return $stm->execute();
    }

    public function delete($idproduto)
    {
        $query = "DELETE FROM $this->tabela WHERE idproduto = :idproduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
        return $stm->execute();
    }
}
