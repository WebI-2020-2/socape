<?php

require_once '../../model/Produto.php';
require_once '../../model/Database.php';

class ProdutosController extends Produto {
    protected $tabela = 'produto';

    public function __construct() { }

    public function findOne($idproduto) {
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

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $produtos = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $produtos,
                new Produto($obj->idproduto, $obj->idmotor, $obj->idcarro, $obj->idvalvulas,  $obj->idfabricacao,  $obj->idcategoria,  $obj->idmarca,  $obj->icms,  $obj->ipi,  $obj->frete,  $obj->valorfabrica,  $obj->valordecompra,  $obj->unidade,  $obj->idlocalizacao, $obj->referencia)
            );
        }
        return $produtos;
    }

    public function insert($nome, $valor, $quantidade) {
        $query = "INSERT INTO $this->tabela (nome, valor, quantidade) VALUES (:nome, :valor, :quantidade)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':valor', $valor);
        $stm->bindParam(':quantidade', $quantidade);
        return $stm->execute();
    }

    public function update($id) {
        $query = "UPDATE $this->tabela SET nome = :nome, valor = :valor, quantidade = :quantidade WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':valor', $this->getValor());
        $stm->bindValue(':quantidade', $this->getQuantidade());
        return $stm->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM $this->tabela WHERE id = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        return $stm->execute();
    }
}