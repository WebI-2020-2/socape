<?php

require_once __DIR__ . '/../model/ItensVenda.php';
require_once __DIR__ . '/../model/Database.php';

class ItensVendaController extends ItensVenda
{
    protected $tabela = 'itensvenda';

    public function __construct()
    {
    }

    public function findOne($iditensvenda)
    {
        $query = "SELECT * FROM $this->tabela WHERE iditensvenda = :iditensvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':iditensvenda', $iditensvenda, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $itemvenda = new ItensVenda(null, null, null, null, null, null, null);
            $itemvenda->setIditensvenda($obj->iditensvenda);
            $itemvenda->setIdproduto($obj->idproduto);
            $itemvenda->setIdvenda($obj->idvenda);
            $itemvenda->setQuantidade($obj->quantidade);
            $itemvenda->setValorvenda($obj->valorvenda);
            $itemvenda->setDesconto($obj->desconto);
            $itemvenda->setLucro($obj->lucro);
        }
        return $itemvenda;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $itensvenda = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $itensvenda,
                new ItensVenda($obj->iditensvenda, $obj->idproduto, $obj->idvenda, $obj->quantidade, $obj->valorvenda, $obj->desconto, $obj->lucro)
            );
        }
        return $itensvenda;
    }

    public function findAllByIdVenda($idvenda)
    {
        $query = "SELECT * FROM $this->tabela WHERE idvenda = :idvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stm->execute();
        $itensvenda = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $itensvenda,
                new ItensVenda($obj->iditensvenda, $obj->idproduto, $obj->idvenda, $obj->quantidade, $obj->valorvenda, $obj->desconto, $obj->lucro)
            );
        }
        return $itensvenda;
    }

    public function countItensByIdVenda($idvenda)
    {
        $query = "SELECT SUM(QUANTIDADE) FROM $this->tabela WHERE idvenda = :idvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stm->execute();

        return intval($stm->fetchColumn());
    }

    public function insert($idproduto, $idvenda, $quantidade, $valorvenda, $desconto)
    {
        $query = "INSERT INTO $this->tabela (idproduto, idvenda, quantidade, valorvenda, desconto, lucro) VALUES (:idproduto, :idvenda, :quantidade, :valorvenda, :desconto, :lucro)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idproduto', $idproduto);
        $stm->bindParam(':idvenda', $idvenda);
        $stm->bindParam(':quantidade', $quantidade);
        $stm->bindParam(':valorvenda', $valorvenda);
        $stm->bindParam(':desconto', $desconto);
        $stm->bindValue(':lucro', 0);

        return $stm->execute();
    }

    // public function update($iditensvenda)
    //  {
    //      $query = "UPDATE $this->tabela SET idcliente = :idcliente, idformapagamento = :idformapagamento, data = :data, valortotal = :valortotal WHERE idvenda = :idvenda";
    //      $stm = Database::prepare($query);
    //      $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
    //      $stm->bindValue(':idcliente', $this->getIdcliente());
    //      $stm->bindValue(':idformapagamento', $this->getIdformapagamento());
    //      $stm->bindValue(':data', $this->getData());
    //      $stm->bindValue(':valortotal', $this->getValortotal());
    //      return $stm->execute();
    // }

    public function delete($iditensvenda)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE iditensvenda = :iditensvenda";
            $stm = Database::prepare($query);
            $stm->bindParam(':iditensvenda', $iditensvenda, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}